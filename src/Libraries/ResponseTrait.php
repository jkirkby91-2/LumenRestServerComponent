<?php

namespace Jkirkby91\LumenRestServerComponent\Libraries;

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
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function createdResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse(json_encode($data),201,$this->getHeaders());
    }

    /**
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function showResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse(json_encode($data),200,$this->getHeaders());
    }

    /**
     * @param array $data
     * @return Diactoros\Response\JsonResponse
     */
    public function listResponse(array $data)
    {
        return new Diactoros\Response\JsonResponse(json_encode($data),2010,$this->getHeaders());
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
        return new Diactoros\Response\JsonResponse(json_encode($data),422,$this->getHeaders());
    }
}