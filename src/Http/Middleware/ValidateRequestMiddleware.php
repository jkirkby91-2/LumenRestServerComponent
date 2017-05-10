<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Middleware;

use Closure;
use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnprocessableEntityException;

class ValidateRequestMiddleware
{

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(ServerRequestInterface $request, Closure $next, $requestValidator)
    {
        $factory = app()->make('validateRequestFactory');

        $validator = $factory::createRequstValidation($requestValidator);

        $validator->ValidateRequest($request);

        return $next($request);
    }

}
