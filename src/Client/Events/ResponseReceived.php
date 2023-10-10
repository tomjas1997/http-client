<?php

namespace Invertus\Http\Client\Events;

use Invertus\Http\Client\Request;
use Invertus\Http\Client\Response;

class ResponseReceived
{
    /**
     * The request instance.
     *
     * @var \Invertus\Http\Client\Request
     */
    public $request;

    /**
     * The response instance.
     *
     * @var \Invertus\Http\Client\Response
     */
    public $response;

    /**
     * Create a new event instance.
     *
     * @param  \Invertus\Http\Client\Request  $request
     * @param  \Invertus\Http\Client\Response  $response
     * @return void
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
