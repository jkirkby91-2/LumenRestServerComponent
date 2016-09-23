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
     * @param ResponseInterface $data
     * @return response
     */
    public function createdResponse(array $data)
    {
        $response = new Diactoros\Response\JsonResponse($data,201,$this->getHeaders());
        return $response;
    }

    /**
     * @param ResponseInterface $data
     * @return response
     */
    public function showResponse($data)
    {
        return new response($data,200,$this->getHeaders());
    }

    /**
     * @param ResponseInterface $data
     * @return response
     */
    public function listResponse($data)
    {
        return new response($data,200,$this->getHeaders());
    }

    /**
     * @return response
     */
    public function notFoundResponse()
    {
        return new response(404,$this->getHeaders());
    }

    /**
     * @return mixed
     */
    public function deletedResponse()
    {
        return new response(204,$this->getHeaders());
    }

    /**
     * @param ResponseInterface $data
     * @return response
     */
    public function clientErrorResponse($data)
    {
        return new response($data,422,$this->getHeaders());
    }
}