<?php

namespace Jkirkby91\LumenRestServerComponent\Libraries;

use Zend\Diactoros;
use Spatie\Fractal\Fractal;

/**
 * Class ResourceResponseTrait
 *
 * @package Jkirkby91\LumenRestServerComponent\Libraries
 * @author James Kirkby <jkirkby91@gmail.com>
 * @TODO abstract this into its own package
 */
trait ResourceResponseTrait
{
    /**
     * @param $data
     * @return Diactoros\Response\JsonResponse
     */
    public function createdResponse($data)
    {
        return new Diactoros\Response\JsonResponse($data,201,$this->getHeaders());
    }

    /**
     * @param $data
     * @return Diactoros\Response\JsonResponse
     */
    public function showResponse($data)
    {
        return new Diactoros\Response\JsonResponse($data,200,$this->getHeaders());
    }

    /**
     * @param $data
     * @return Diactoros\Response\JsonResponse
     */
    public function listResponse($data)
    {
        trigger_error("Deprecated function called.", E_USER_NOTICE);
        throw new \Exception('function deprecated');
        return new Diactoros\Response\JsonResponse($data,201,$this->getHeaders());
    }

    /**
     * @return Diactoros\Response\JsonResponse
     */
    public function deletedResponse()
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'success',
            'msg' => 'Successfully deleted resource.'
        ],204,$this->getHeaders());
    }

    /**
     * @return Diactoros\Response\JsonResponse
     */
    public function completedResponse()
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'success',
            'msg' => 'Successfully completed response.'
        ],204,$this->getHeaders());
    }

    /**
     * @return Diactoros\Response\JsonResponse
     */
    public function clientErrorResponse($msg = 'Un-processable Entity.')
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'error',
            'error' => 'entity.invalid',
            'msg' => $msg
        ],422,$this->getHeaders());
    }

    /**
     * @return Diactoros\Response\JsonResponse
     */
    public function notFoundResponse()
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'error',
            'error' => 'Not Found',
            'msg' => 'Resource Not Found.'
        ],404,$this->getHeaders());
    }

    /**
     * @return Diactoros\Response\JsonResponse
     */
    public function UnauthorizedResponse()
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'error',
            'error' => 'Unauthorized',
            'msg' => 'Credentials dont match.'
        ],403,$this->getHeaders());
    }

    /**
     * @param $msg
     * @return Diactoros\Response\JsonResponse
     */
    public function serverErrorResponse($msg = 'Internal Server Error')
    {        
        return new Diactoros\Response\JsonResponse([
            'status' => 'error',
            'error' => 'Server Error',
            'msg' => $msg
        ],500,$this->getHeaders());
    }

    public function exceptionResponse($code,$msg)
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'error',
            'error'  => $code,
            'msg'    => $msg
        ],$code,$this->getHeaders());
    }
}