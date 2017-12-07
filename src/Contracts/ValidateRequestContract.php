<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Contracts {

		use Psr\{
			Http\Message\ServerRequestInterface
		};

		/**
		 * Interface ValidateRequestContract
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Contracts
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		interface ValidateRequestContract
		{
			/**
			 * @return mixed
			 */
			public function rules(ServerRequestInterface $request);

			/**
			 * @param ServerRequestInterface $request
			 * @return mixed
			 */
			public function validateRequest(ServerRequestInterface $request);
		}
	}