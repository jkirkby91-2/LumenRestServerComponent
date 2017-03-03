<?php

namespace Jkirkby91\LumenRestServerComponent\Contracts;

use Closure;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface MiddlewareContract
 *
 * @package Jkirkby91\LumenRestServerComponent\Contracts
 * @author James Kirkby <me@jameskirkby.com>
 */
interface MiddlewareContract
{
	
    /**
     * @return mixed
     */
    public function handle(ServerRequestInterface $request, Closure $next);
}