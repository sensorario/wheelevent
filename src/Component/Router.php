<?php

namespace Component;

use Response\ClientError;
use Objects\Route;

class Router
{
    private $security;

    private $validator;

    public function controller($request)
    {
        $uris = require __DIR__ . '/../../config/router.php';

        foreach ($uris as $route) {
            if ($route['path'] === $request->getUri()) {
                if (!$this->security->allow(Route::fromArray($route))) {
                    return new ClientError(403);
                }

                $controller = new $route['controller']();
                if (method_exists($controller, $request->getMethod())) {
                    return $controller->{$request->getMethod()}($request);
                }
            }
        }

        return new ClientError(404);
    }

    public function protectRouteWith(Security $security)
    {
        $this->security = $security;
    }

    public function validateClientWith(Validator $validator)
    {
        $this->validator = $validator;
    }
}
