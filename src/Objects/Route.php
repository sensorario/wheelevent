<?php

namespace Objects;

class Route
{
    private $params;

    private function __construct(array $params)
    {
        $this->params = $params;
    }

    public static function fromArray(array $params)
    {
        return new self($params);
    }

    public function isPublic()
    {
        return !isset($this->params['security']);
    }

    public function isProtected()
    {
        return isset($this->params['security']);
    }
}
