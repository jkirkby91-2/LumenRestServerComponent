<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Requests {

		use Laravel\{
			Lumen\Routing\Closure
		};

		use Psr\{
			Http\Message\ServerRequestInterface
		};

		use Illuminate\{
			Validation\ValidationException
		};

		use Jkirkby91\{
			LumenRestServerComponent\Contracts\ValidateRequestContract,
			Boilers\RestServerBoiler\Exceptions\UnprocessableEntityException
		};

		/**
		 * Class AbstractMiddleware
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Middleware
		 * @author James Kirkby <hello@jameskirkby.com>
		 */
		abstract class AbstractValidateRequest implements ValidateRequestContract
		{

			/**
			 * @var \Illuminate\Validation\Validator $param
			 */
			protected $validator;

			/**
			 * validateRequest()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 *
			 * @return bool
			 */
			public function validateRequest(ServerRequestInterface $request) : bool
			{
				$this->validator = app()->make('validator');

				$method = $request->getMethod();
				$rules = $this->rules($request);

				if ($rules === null){
					return TRUE;
				}

				$this->validator = $this->validator->make($request->getParsedBody(),$rules[$method]);

				try {
					$this->validator->validate();
					return TRUE;
				} catch (ValidationException $e){
					throw new UnprocessableEntityException;
				}
			}
		}
	}
