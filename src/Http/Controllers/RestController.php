<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Illuminate\Routing\Controller;
use Jkirkby91\LumenRestServerComponent\Libraries\ResponseTrait;
use Jkirkby91\Boilers\RestServerBoiler\ResourceResponseContract;
use Spatie\Fractal\ArraySerializer as ArraySerialization;

/**
 * Class RestController
 *
 * A RestController Boiler Plate
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
abstract class RestController extends Controller implements ResourceResponseContract
{

    use ResponseTrait;

    /**
     * @var array
     */
    private $privateHeaders = [
        'Rest-Server'    => 'Jkirkby91\\LumenRestServerComponent',
        'Version'        => '0.0.1',
        'content-type'   =>  'text/json'
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
     * @param $item
     * @return $this
     */
    public function item($item)
    {
        return fractal()->item($item,$this->transformer);
    }

    /**
     * @param $collection
     * @return $this
     */
    public function collection($collection)
    {
        return fractal()->collection($collection,$this->transformer);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders(array $headers)
    {
        array_push($this->headers, $headers);
    }
}