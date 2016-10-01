<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Illuminate\Routing\Controller;
use Jkirkby91\LumenRestServerComponent\Libraries\ResponseTrait;

/**
 * Class RestController
 *
 * A RestController Boiler Plate
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
abstract class RestController extends Controller
{

    use ResponseTrait;

    /**
     * @var array
     */
    private $privateHeaders = [
        'Rest-Server'    => 'Jkirkby91\\LumenRestServerComponent',
        'Version'        => '0.0.1',
        'content-type'   =>  'text/json'
    ];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var \League\Fractal\Serializer\ArraySerializer
     */
    public $serializer;

    /**
     * RestController constructor.
     */
    public function __construct()
    {
        $this->serializer = new \Spatie\Fractal\ArraySerializer;
    }

    /**
     * @param $item
     * @return $this
     */
    public function item($item)
    {
        $itemResource = fractal()->item($item,$this->transformer);
        return $itemResource;
    }

    /**
     * @param $collection
     * @return $this
     */
    public function collection($collection)
    {
        $itemResource = fractal()->collection($collection,$this->transformer);
        return $itemResource;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
//        return array_merge($this->privateHeaders,$this->headers);
        return $this->headers;
    }
}