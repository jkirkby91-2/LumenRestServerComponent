<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Http\Controllers {

		use Psr\{
			Http\Message\ServerRequestInterface
		};

		use Jkirkby91\{
			Boilers\RestServerBoiler\CrudControllerContract,
			Boilers\RepositoryBoiler\CrudRepositoryContract as CrudRepository
		};

		use Zend\Diactoros\Response\JsonResponse;

		/**
		 * Class ResourceController
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
		 * @author James Kirkby <jkirkby91@gmail.com>
		 */
		class CrudController extends RestController implements CrudControllerContract
		{

			/**
			 * @var CrudRepository $repository
			 */
			protected $repository;

			/**
			 * CrudController constructor.
			 *
			 * @param \Jkirkby91\Boilers\RepositoryBoiler\CrudRepositoryContract $repository
			 */
			public function __Construct(CrudRepository $repository)
			{
				parent::__construct();
				$this->repository = $repository;
			}

			/**
			 * create()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 *
			 * @return \Zend\Diactoros\Response\JsonResponse
			 */
			public function create(ServerRequestInterface $request) : JsonResponse
			{
				$entity = $request->getParsedBody();
				$entity = $this->repository->create($entity);
				return $this->createdResponse(['status' => 'success', 'entity_id' => $entity->getId()]);
			}

			/**
			 * read()
			 * @param int $id
			 *
			 * @return \Zend\Diactoros\Response\JsonResponse
			 */
			public function read(int $id) : JsonResponse
			{
				return $this->repository->read($id);
			}

			/**
			 * update()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 *
			 * @return \Zend\Diactoros\Response\JsonResponse
			 */
			public function update(ServerRequestInterface $request) : JsonResponse
			{
				$entity = $request->getParsedBody();
				$entity = $this->repository->update($entity);
				return $this->createdResponse(['status' => 'success', 'entity_id' => $entity->getId()]);
			}

			/**
			 * delete()
			 * @param int $id
			 *
			 * @return \Zend\Diactoros\Response\JsonResponse
			 */
			public function delete(int $id) : JsonResponse
			{
				return $this->repository->delete($id);
			}
		}
	}