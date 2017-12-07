<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Middleware {

		use Closure;

		use Psr\{
			Http\Message\ServerRequestInterface
		};

		use Jkirkby91\{
			Boilers\RestServerBoiler\Exceptions\UnprocessableEntityException
		};

		use Symfony\{
			Component\HttpFoundation\Response
		};

		/**
		 * Class ValidateRequestMiddleware
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		class ValidateRequestMiddleware
		{

			/**
			 * handle()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 * @param \Closure                                 $next
			 * @param                                          $requestValidator
			 *
			 * @return \Symfony\Component\HttpFoundation\Response
			 */
			public function handle(ServerRequestInterface $request, Closure $next, $requestValidator) : Response
			{
				$factory = app()->make('validateRequestFactory');

				$validator = $factory::createRequestValidation($requestValidator);

				$validator->validateRequest($request);

				return $next($request);
			}
		}
	}
