<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Requests;

/**
 * Class RequestValidationFactory
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
 * @author James Kirkby <me@jameskirkby.com>
 */
class ValidateRequestFactory
{

    /**
     * @param ServerRequestInterface $request
     * @return mixed|void
     */
    public static function createRequstValidation($requestValidator)
    {
      return new $requestValidator;
    }

}
