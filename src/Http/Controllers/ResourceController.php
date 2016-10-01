<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\Boilers\RestServerBoiler\ResourceResponseContract;
use Jkirkby91\Boilers\RestServerBoiler\ResourceControllerContract;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\RestController;
use Jkirkby91\Boilers\RestServerBoiler\TransformerContract AS ObjectTransformer;
use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract AS ResourceRepository;

/**
 * Class ResourceController
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
abstract class ResourceController extends RestController implements ResourceControllerContract, ResourceResponseContract
{
    /**
     * @var ResourceRepository
     */
    protected $repository;

    /**
     * @var ObjectTransformer
     */
    protected $transformer;

    /**
     * RestController constructor.
     *
     * @param ResourceRepository $repository
     * @param ObjectTransformer $objectTransformer
     */
    public function __construct(ResourceRepository $repository, ObjectTransformer $objectTransformer)
    {
        $this->repository       = $repository;
        $this->transformer      = $objectTransformer;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->listResponse($this->repository->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        if($data = $this->repository->find($id))
        {
            return Fractal()
                ->item($data)
                ->transformWith($this->transformer)
                ->serializeWith(new \Spatie\Fractal\ArraySerializer())
                ->toJson();
        }
        throw new NotFoundHttpException;
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function store(ServerRequestInterface $request)
    {
        $entity = $request->getParsedBody();

        $data = $this->repository->store($entity);

//        try
//        {
//            $v = \Validator::make($data, $this->validationRules);
//            if($v->fails())
//            {
//                throw new \Exception("ValidationException");
//            }
//            $data = $this->repository->create($data);
//            return $this->createdResponse($data);
//        } catch(\Exception $ex)
//        {
//            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
//            return $this->clientErrorResponse($data);
//        }

        return Fractal()
            ->item($data)
            ->transformWith($this->transformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toJson();

    }

    /**
     * @param ServerRequestInterface $request
     * @param $id
     * @return mixed
     */
    public function update(ServerRequestInterface $request,$id)
    {
        if(!$data = $this->repository->find($id))
        {
            throw new NotFoundHttpException;
        }

//        try
//        {
//            $v = \Validator::make($request->all(), $this->validationRules);
//            if($v->fails())
//            {
//                throw new \Exception("ValidationException");
//            }
//            $this->repository->update($request->all());
//            return $this->showResponse($data);
//        }catch(\Exception $ex)
//        {
//            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
//            return $this->clientErrorResponse($data);
//        }

        $this->repository->update($request->all());
        return $this->response()->item($data,$this->transformer);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if(!$data = $this->repository->find($id))
        {
            throw new NotFoundHttpException;
        }

        $this->repository->destory($id);

        return $this->deletedResponse();
    }
}