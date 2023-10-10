<?php

namespace Invertus\Http\Client\Events;

use Invertus\Http\Client\Request;

class RequestSending
{
    /**
     * The request instance.
     *
     * @var \Invertus\Http\Client\Request
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param  \Invertus\Http\Client\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
