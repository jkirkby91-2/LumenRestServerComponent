<?php

namespace Jkirkby91\LumenRestServerComponent\Contracts;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RequestContract
 *
 * @package ApiArchitect\Compass\Contracts
 * @author James Kirkby <me@jameskirkby.com>
 */
interface ValidateRequestContract
{
    /**
     * @return mixed
     */
    public function rules();

    /**
     * @param ServerRequestInterface $request
     * @return mixed
     */
    public function validateRequest(ServerRequestInterface $request);
}