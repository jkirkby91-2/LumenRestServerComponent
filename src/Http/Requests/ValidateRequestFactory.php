<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Requests {

		use Jkirkby91\{
			LumenRestServerComponent\Http\Requests\AbstractValidateRequest
		};

		/**
		 * Class ValidateRequestFactory
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Requests
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		class ValidateRequestFactory
		{

			/**
			 * createRequestValidation()
			 * @param string $requestValidator
			 *
			 * @return \Jkirkby91\LumenRestServerComponent\Http\Requests\AbstractValidateRequest
			 */
			public static function createRequestValidation(string $requestValidator) : AbstractValidateRequest
			{
				return new $requestValidator;
			}

		}
	}
