<?php

namespace Jkirkby91\LumenRestServerComponent\Http\Controllers;

use Spatie\Fractal\ArraySerializer as ArraySerialization;

/**
 * Class PingController
 *
 * @package Jkirkby91\LumenRestServerComponent\Http\Controllers
 * @author James Kirkby <jkirkby91@gmail.com>
 */
class PingController extends \Jkirkby91\LumenRestServerComponent\Http\Controllers\RestController
{
    use \Jkirkby91\LumenRestServerComponent\Libraries\ResponseTrait;
    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function ping()
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