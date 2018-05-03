<?php

namespace Jtn\Transmission;

class RPCResponse
{

    protected $body = [];

    protected $status = '';

    public function __construct($response)
    {
        $this->status = $response->result;
        $this->body = $response->arguments;
    }

    /**
     * @return array|\stdClass
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function success()
    {
        return $this->status === 'success';
    }

}
