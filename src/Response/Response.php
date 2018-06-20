<?php

namespace Response;

class Response implements PubApi\GenericResponse
{
    private $code;

    private $content;

    public function __construct(array $content, $code = 200)
    {
        $this->code = $code;
        $this->content = $content;
    }

    public function getHttpStatusCode()
    {
        return $this->code;
    }

    public function getContent()
    {
        return json_encode($this->content);
    }
}
