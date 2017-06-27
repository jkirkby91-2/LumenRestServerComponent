<?php

	namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

	use Illuminate\Routing\Controller;
	use Psr\Http\Message\ServerRequestInterface;
	use Spatie\Fractal\ArraySerializer as ArraySerialization;
	use Jkirkby91\Boilers\RestServerBoiler\ResourceResponseContract;
	use Jkirkby91\Boilers\RestServerBoiler\Exceptions\NotFoundHttpException;
	use Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnauthorizedHttpException;
	use Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnprocessableEntityException;

	/**
	 * Class RestController
	 *
	 * A RestController Boiler Plate
	 * 
	 *
	 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
	 * @author  James Kirkby <jkirkby@protonmail.ch>
	 */
	abstract class RestController extends Controller
	{
		/**
		 * @var array
		 */
		private $privateHeaders = [
			'Rest-Server'    => 'Jkirkby91\\LumenRestServerComponent',
			'Version'        => 'Alpha-1.0.1',
			'content-type'   => 'text/json'
		]; //@TODO hook headers into our responses

		/**
		 * @var array
		 */
		protected $headers = [];

		/**
		 * @var \League\Fractal\Serializer\ArraySerializer
		 */
		protected $serializer;

		/**
		 * RestController constructor.
		 */
		public function __construct()
		{
			// $this->headers->set('Rest-Server',$this->privateHeaders['Rest-Server']);
			// $this->headers->set('Version',$this->privateHeaders['Version']);
			// $this->headers->set('content-type',$this->privateHeaders['content-type']);
			// $this->withHeaders($this->privateHeaders);
			$this->serializer = new ArraySerialization();
		}

		/**
		 * item()
		 * @param $item
		 *
		 * @return $this
		 */
		public function item($item)
		{
			return fractal()->item($item);
		}

		/**
		 * collection()
		 * @param $collection
		 *
		 * @return $this
		 */
		public function collection($collection)
		{
			return fractal()->collection($collection);
		}

		/**
		 * getHeaders()
		 * @return array
		 */
		public function getHeaders()
		{
			return $this->headers;
		}

		/**
		 * setHeaders()
		 * @param array $headers
		 */
		public function setHeaders(array $headers)
		{
			array_push($this->headers, $headers);
		}

		/**
		 * paginateResults()
		 * @param $results
		 * @param $page
		 *
		 * @return mixed
		 */
		public function paginateResults($results,$page)
		{
			try {
				$paginatedResults = $this->repository->lumenPaginatedQuery($results,$page);
			} catch (\Exception $e){
				throw new UnprocessableEntityException($e->getMessage());
			}

			$paginatedResults = $paginatedResults->toArray();

			if(isset($paginatedResults))
			{
				$paginatedResults['data'] = $this->collection($paginatedResults['data'])
					->transformWith($this->transformer)
					->serializeWith(new ArraySerialization());
				return $paginatedResults;
			} else {
				throw new NotFoundHttpException;
			}
		}

		/**
		 * getPaginationPageFromRequest()
		 * @param \Psr\Http\Message\ServerRequestInterface $request
		 *
		 * @return int|mixed
		 */
		public function getPaginationPageFromRequest(ServerRequestInterface $request)
		{
			$queryParams = $request->getQueryParams();

			if(!isset($queryParams['page']) || is_null($queryParams['page'])) {
				$page = 1;
			} else {
				$page = filter_var($queryParams['page'],FILTER_SANITIZE_STRING);
			}

			return $page;
		}
		
	}