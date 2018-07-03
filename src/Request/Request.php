<?php

namespace Request;

class Request
{
    private $uri;

    private $method;

    public function __construct(array $params = [])
    {
        $server = $params === []
            ? $_SERVER
            : $params;

        $this->uri    = $server['REQUEST_URI'];
        $this->method = $server['REQUEST_METHOD'];
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return strtolower($this->method);
    }

    public function getJson()
    {
        $content = file_get_contents('php://input');
        return json_decode($content);
    }
}
