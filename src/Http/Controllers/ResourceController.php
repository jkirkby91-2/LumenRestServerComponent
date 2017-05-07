<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Spatie\Fractal\ArraySerializer AS ArraySerialization;
use Jkirkby91\Boilers\RestServerBoiler\ResourceControllerContract;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\RestController;
use Jkirkby91\Boilers\RestServerBoiler\Exceptions\NotFoundHttpException;
use Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnauthorizedHttpException;
use Jkirkby91\Boilers\RestServerBoiler\TransformerContract AS ObjectTransformer;
use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract AS ResourceRepository;

/**
 * Class ResourceController
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
abstract class ResourceController extends RestController implements ResourceControllerContract
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
        parent::__construct();
        $this->repository   = $repository;
        $this->transformer  = $objectTransformer;
    }

    /**
     * @return mixed
     */
    public function index(ServerRequestInterface $request)
    {
        $page = $this->getPaginationPageFromRequest($request);

        try {
            //@TODO implement softdelete and search on criteria that is still active
            $results = $this->repository->findBy([],['id'=>'desc']);
        } catch (ORMInvalidArgumentException $e){
            $this->clientErrorResponse('Invalid Search Criteria');
        } catch (ORMException $e){
            return $this->serverErrorResponse();
        }
        
        try {
            $paginatedResults = $this->paginateResults($results,$page);
        } catch (UnprocessableEntityException $e) {
            return $this->serverErrorResponse();
        } catch (NotFoundHttpException $e) {
            return $this->notFoundResponse();
        }

        return $this->showResponse($paginatedResults);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        if($data = $this->repository->find($id))
        {
            $entity = $this->item($data)
                        ->transformWith($this->transformer)
                        ->serializeWith(new ArraySerialization());
        } else {
            throw new NotFoundHttpException();
        }

        return $this->showResponse($entity);
    }

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    abstract public function store(ServerRequestInterface $request);

    /**
     * @param ServerRequestInterface $request
     * @param $id
     * @return mixed|void
     * @throws \Exception
     */
    abstract public function update(ServerRequestInterface $request, $id);

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
