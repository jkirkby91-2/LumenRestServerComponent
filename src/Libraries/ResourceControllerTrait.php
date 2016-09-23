<?php

namespace Jkirkby91\LumenRestServerComponent\Libraries;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ResourceControllerTrait
 *
 * @package Jkirkby91\LumenRestServerComponent\Libraries
 * @author James Kirkby <me@jameskirkby.com>
 */
trait ResourceControllerTrait
{

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
        $data = $this->repository->create($request->all());

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

        return $this->response()->item($data,$this->transformer);

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
