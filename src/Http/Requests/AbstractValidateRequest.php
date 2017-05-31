<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Requests;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\LumenRestServerComponent\Contracts\ValidateRequestContract;
use Illuminate\Validation\ValidationException;
use Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnprocessableEntityException;

/**
 * Class AbstractMiddleware
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class AbstractValidateRequest implements ValidateRequestContract
{

    protected $validator;

    /**
     * @param ServerRequestInterface $request
     * @return mixed|void
     */
    public function ValidateRequest(ServerRequestInterface $request)
    {
        $this->validator = app()->make('validator');
        $method = $request->getMethod();
        $rules = $this->rules($request);

        if($rules === null){
          return true;
        }

        try {
          $this->validator->validate($request->getParsedBody(),$rules[$method]);
        } catch (ValidationException $e){
          throw new \Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnprocessableEntityException;
        }

    }

}
