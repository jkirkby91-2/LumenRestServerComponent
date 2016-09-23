<?php

namespace Jkirkby91\LumenRestServerComponent\Libraries;

use Jkirkby91\Boilers\RestServerBoiler\TransformerContract;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros;

/**
 * Class ResourceResponseTrait
 *
 * @package Jkirkby91\LumenRestServerComponent\Libraries
 */
trait ResourceResponseTrait
{

    /**
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function createdResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse($data,201,$this->getHeaders());
    }

    /**
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function showResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse($data,200,$this->getHeaders());
    }

    /**
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function listResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse($data,2010,$this->getHeaders());
    }

    /**
     * @return Diactoros\Response\JsonResponse
     */
    public function notFoundResponse()
    {
        return new Diactoros\Response\JsonResponse(null,404,$this->getHeaders());
    }

    /**
     * @return mixed
     */
    public function deletedResponse()
    {
        return new Diactoros\Response\JsonResponse(null,204,$this->getHeaders());
    }

    /**
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function clientErrorResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse($data,422,$this->getHeaders());
    }
}