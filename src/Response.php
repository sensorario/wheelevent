<?php

class Response
{
    private $code;

    public function __construct($code = 200)
    {
        $this->code = $code;
    }

    public function getHttpStatusCode()
    {
        return $this->code;
    }

    public function getContent()
    {
        return json_encode([
            'success' => 'true',
        ]);
    }
}
