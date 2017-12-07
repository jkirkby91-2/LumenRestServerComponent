<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Middleware {

		use Closure;

		use Psr\{
			Http\Message\ServerRequestInterface
		};

		use Jkirkby91\{
			LumenRestServerComponent\Contracts\MiddlewareContract
		};

		/**
		 * Class AbstractMiddleware
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		abstract class AbstractMiddleware implements MiddlewareContract
		{

			/**
			 * handle()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 * @param \Closure                                 $next
			 *
			 * @return mixed
			 */
			abstract public function handle(ServerRequestInterface $request, Closure $next);

		}
	}
