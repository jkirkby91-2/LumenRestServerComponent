<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Jkirkby91\Boilers\RestServerBoiler\CrudControllerContract;
use Jkirkby91\Boilers\RepositoryBoiler\CrudRepositoryContract AS CrudRepository;

/**
 * Class ResourceController
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
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
        $this->repository       = $repository;
    }

    public function create(ServerRequestInterface $request)
    {
        // TODO: Implement create() method.
    }

    public function read($id)
    {
        // TODO: Implement read() method.
    }

    public function update(ServerRequestInterface $request)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}