<?php

	namespace Jkirkby91\LumenRestServerComponent\Http\Requests {

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
			 * @param $requestValidator
			 *
			 * @return \Jkirkby91\LumenRestServerComponent\Http\Requests\AbstractValidateRequest
			 */
			public static function createRequestValidation($requestValidator)
			{
				return new $requestValidator;
			}

		}
	}
