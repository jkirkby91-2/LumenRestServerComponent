<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Controllers {

		use Spatie\{
			Fractal\ArraySerializer as ArraySerialization
		};

		use Jkirkby91\{
			LumenRestServerComponent\Libraries\ResourceResponseTrait
		};
		use Zend\Diactoros\Response\JsonResponse;

		/**
		 * Class PingController
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		class PingController extends \Jkirkby91\LumenRestServerComponent\Http\Controllers\RestController
		{
			use ResourceResponseTrait;

			/**
			 * ping()
			 * @return \Zend\Diactoros\Response\JsonResponse
			 */
			public function ping() : JsonResponse
			{
				$ping = ['server' => 'Jkirkby91\\LumenRestServerComponent','server_version' => '0.0.1', 'server_time' => new \DateTime()];

				$resource = fractal()
					->item($ping)
					->transformWith(function($ping) { return ['server' => $ping['server'],'version' => $ping['server_version'], 'time' => $ping['server_time']];})
					->serializeWith(new ArraySerialization())
					->toArray();

				return $this->showResponse($resource);
			}
		}
	}
