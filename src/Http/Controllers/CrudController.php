<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Jkirkby91\Boilers\RestServerBoiler\CrudControllerContract;
use Jkirkby91\Boilers\RepositoryBoiler\CrudRepositoryContract AS CrudRepository;

/**
 * Class ResourceController
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 */
abstract class CrudController extends RestController implements CrudControllerContract
{
    use CrudControllertrait;

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
}