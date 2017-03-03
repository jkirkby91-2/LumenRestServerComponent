<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\LumenRestServerComponent\Contracts\MiddlewareContract;
use Jkirkby91\LumenRestServerComponent\Http\Middleware\AbstractValidateRequest;

/**
 * Class ValidateRequest
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class ValidateRequestMiddleware extends AbstractValidateRequest implements MiddlewareContract
{

	protected $validator;

    /**
     * @param ServerRequestInterface $request
     * @return mixed|void
     */
    public function ValidateRequest(ServerRequestInterface $request)
    {
        $this->validator = app()->make('validator');
        $method =$request->getMethod();
        $rules = $this->rules();
        $this->validator->validate($request->getParsedBody(),$rules[$method]);
    }
}
