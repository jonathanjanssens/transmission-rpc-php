<?php

namespace Jtn\Transmission\Operations;

abstract class AbstractOperation
{

    protected $method = '';

    /**
     * @return array
     */
    abstract public function parameters();

    /**
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

}
