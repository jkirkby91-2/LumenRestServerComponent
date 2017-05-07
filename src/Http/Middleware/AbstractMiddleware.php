<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Middleware;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\LumenRestServerComponent\Contracts\MiddlewareContract;

abstract class AbstractMiddleware implements MiddlewareContract
{

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    abstract public function handle(ServerRequestInterface $request, Closure $next);

}
