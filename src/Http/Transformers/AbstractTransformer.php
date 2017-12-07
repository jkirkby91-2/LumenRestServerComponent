<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Transformers {

		use League\{
			Fractal\TransformerAbstract
		};

		/**
		 * Class AbstractTransformer
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Transformers
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		abstract class AbstractTransformer extends TransformerAbstract {}
	}