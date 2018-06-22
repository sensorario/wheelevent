<?php

namespace Objects;

class Config
{
    private $routes = [];

    public function __construct()
    {
        $this->routes = require __DIR__ . '/../../config/router.php';
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
