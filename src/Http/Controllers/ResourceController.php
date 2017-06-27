<?php

	namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

	use Psr\Http\Message\ServerRequestInterface;
	use Spatie\Fractal\ArraySerializer AS ArraySerialization;
	use Jkirkby91\Boilers\RestServerBoiler\ResourceControllerContract;
	use Jkirkby91\LumenRestServerComponent\Libraries\ResourceResponseTrait;
	use Jkirkby91\LumenRestServerComponent\Http\Controllers\RestController;
	use Jkirkby91\Boilers\RestServerBoiler\Exceptions\NotFoundHttpException;
	use Jkirkby91\Boilers\RestServerBoiler\Exceptions\UnauthorizedHttpException;
	use Jkirkby91\Boilers\RestServerBoiler\TransformerContract AS ObjectTransformer;
	use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract AS ResourceRepository;

	/**
	 * Class ResourceController
	 *
	 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
	 * @author  James Kirkby <jkirkby@protonmail.ch>
	 */
	abstract class ResourceController extends RestController implements ResourceControllerContract
	{

		use ResourceResponseTrait;

		/**
		 * @var \Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract
		 */
		protected $repository;

		/**
		 * @var \Jkirkby91\Boilers\RestServerBoiler\TransformerContract
		 */
		protected $transformer;

		/**
		 * ResourceController constructor.
		 *
		 * @param \Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract $repository
		 * @param \Jkirkby91\Boilers\RestServerBoiler\TransformerContract        $objectTransformer
		 */
		public function __construct(ResourceRepository $repository, ObjectTransformer $objectTransformer)
		{
			parent::__construct();
			$this->repository   = $repository;
			$this->transformer  = $objectTransformer;
		}

		/**
		 * index()
		 * @param \Psr\Http\Message\ServerRequestInterface $request
		 *
		 * @return \Zend\Diactoros\Response\JsonResponse
		 */
		public function index(ServerRequestInterface $request)
		{
			$page = $this->getPaginationPageFromRequest($request);

			try {
				//@TODO implement softdelete and search on criteria that is still active
				$results = $this->repository->findBy([],['id'=>'desc']);
			} catch (ORMInvalidArgumentException $e){
				$this->clientErrorResponse('Invalid Search Criteria');
			} catch (ORMException $e){
				return $this->serverErrorResponse();
			}

			try {
				$paginatedResults = $this->paginateResults($results,$page);
			} catch (UnprocessableEntityException $e) {
				return $this->serverErrorResponse();
			} catch (NotFoundHttpException $e) {
				return $this->notFoundResponse();
			}

			return $this->showResponse($paginatedResults);
		}

		/**
		 * show()
		 * @param $id
		 *
		 * @return \Zend\Diactoros\Response\JsonResponse
		 */
		public function show($id)
		{
			if ($data = $this->repository->find($id))
			{
				$entity = $this->item($data)
					->transformWith($this->transformer)
					->serializeWith($this->serializer);
			} else {
				throw new NotFoundHttpException();
			}

			return $this->showResponse($entity);
		}

		/**
		 * store()
		 * @param \Psr\Http\Message\ServerRequestInterface $request
		 *
		 * @return mixed
		 */
		abstract public function store(ServerRequestInterface $request);

		/**
		 * update()
		 * @param \Psr\Http\Message\ServerRequestInterface $request
		 * @param                                          $id
		 *
		 * @return mixed
		 */
		abstract public function update(ServerRequestInterface $request, $id);

		/**
		 * destroy()
		 * @param $id
		 *
		 * @return \Zend\Diactoros\Response\JsonResponse
		 */
		public function destroy($id)
		{
			if(!$data = $this->repository->find($id))
			{
				throw new NotFoundHttpException;
			}

			$this->repository->destory($id);

			return $this->deletedResponse();
		}
	}
