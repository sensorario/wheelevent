<?php

namespace Request;

class Request
{
    private $uri;

    private $method;

    public function __construct()
    {
        $this->uri    = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return strtolower($this->method);
    }
}
