<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Middleware;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\LumenRestServerComponent\Contracts\ValidateRequestContract;

/**
 * Class AbstractMiddleware
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class AbstractValidateRequest implements ValidateRequestContract
{
    abstract public function ValidateRequest(ServerRequestInterface $request);
}
