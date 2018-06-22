<?php

namespace Component;

use Objects\Config;
use Objects\Route;
use Response\ClientError;

class Router
{
    private $security;

    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function controller($request)
    {
        $uris = $this->config->getRoutes();

        $method = $request->getMethod();

        foreach ($uris as $route) {
            if ($route['path'] === $request->getUri()) {
                if (!$this->security->allow(Route::fromArray($route))) {
                    return new ClientError(403);
                }

                $controller = new $route['controller']();
                if (method_exists($controller, $method)) {
                    return $controller->{$method}($request);
                }
            }
        }

        return new ClientError(404);
    }

    public function protectRouteWith(Security $security)
    {
        $this->security = $security;
    }
}
