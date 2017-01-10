<?php

namespace Jkirkby91\LumenRestServerComponent\Libraries;

use Spatie\Fractal\Fractal;
use Zend\Diactoros;

/**
 * Class ResponseTrait
 *
 * @package Jkirkby91\LumenRestServerComponent\Libraries
 * @author James Kirkby <jkirkby91@gmail.com>
 * @TODO abstract this into its own package
 */
trait ResponseTrait
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
        return new Diactoros\Response\JsonResponse($data,2010,$this->getHeaders());
    }

    /**
     * @return mixed
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
    public function clientErrorResponse()
    {
        return new Diactoros\Response\JsonResponse([
            'status' => 'error',
            'error' => 'entity.invalid',
            'msg' => 'Un-processable Entity.'
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
}