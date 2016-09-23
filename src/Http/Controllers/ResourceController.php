<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Jkirkby91\Boilers\RestServerBoiler\ResourceResponseContract;
use Jkirkby91\Boilers\RestServerBoiler\ResourceControllerContract;
use Jkirkby91\LumenRestServerComponent\Http\Controllers\RestController;
use Jkirkby91\Boilers\RestServerBoiler\TransformerContract AS ObjectTransformer;
use Jkirkby91\Boilers\RepositoryBoiler\ResourceRepositoryContract AS ResourceRepository;

/**
 * Class ResourceController
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 */
abstract class ResourceController extends RestController implements ResourceControllerContract, ResourceResponseContract
{
    use \Jkirkby91\LumenRestServerComponent\Libraries\ResourceResponseTrait,
        \Jkirkby91\LumenRestServerComponent\Libraries\ResourceControllerTrait;

    /**
     * @var ResourceRepository
     */
    protected $repository;

    /**
     * @var ObjectTransformer
     */
    protected $transformer;

    /**
     * RestController constructor.
     *
     * @param ResourceRepository $repository
     * @param ObjectTransformer $objectTransformer
     */
    public function __construct(ResourceRepository $repository, ObjectTransformer $objectTransformer)
    {
        $this->repository       = $repository;
        $this->transformer      = $objectTransformer;
    }
}