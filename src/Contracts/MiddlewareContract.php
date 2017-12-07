<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Contracts {

		use Closure;

		use Psr\{
			Http\Message\ServerRequestInterface
		};

		/**
		 * Interface MiddlewareContract
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Contracts
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		interface MiddlewareContract
		{

			/**
			 * handle()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 * @param \Closure                                 $next
			 *
			 * @return mixed
			 */
			public function handle(ServerRequestInterface $request, Closure $next);
		}
	}