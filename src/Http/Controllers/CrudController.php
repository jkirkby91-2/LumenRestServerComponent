<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\Boilers\RestServerBoiler\CrudControllerContract;
use Jkirkby91\Boilers\RepositoryBoiler\CrudRepositoryContract AS CrudRepository;

/**
 * Class ResourceController
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
class CrudController extends RestController implements CrudControllerContract
{

    /**
     * @var
     */
    protected $repository;

    /**
     * CrudController constructor.
     *
     * @param CrudRepository $repository
     */
    public function __construct(CrudRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response\JsonResponse
     */
    public function create(ServerRequestInterface $request)
    {
        $entity = $request->getParsedBody();
        $entity = $this->repository->create($entity);
        return $this->createdResponse(['status' => 'success', 'entity_id' => $entity->getId()]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function read($id)
    {
        return $this->repository->read($id);
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function update(ServerRequestInterface $request)
    {
        $entity = $request->getParsedBody();
        $entity = $this->repository->update($entity);
        return $this->createdResponse(['status' => 'success', 'entity_id' => $entity->getId()]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}