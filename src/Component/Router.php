<?php

namespace Component;

use Response\FailureResponse;

class Router
{
    public function controller($request)
    {
        $uris = require __DIR__ . '/../../config/router.php';

        foreach ($uris as $endpoint) {
            if ($endpoint['path'] === $request->getUri()) {
                $controller = new $endpoint['controller']();
                if (method_exists($controller, $request->getMethod())) {
                    return $controller->{$request->getMethod()}($request);
                }
            }
        }

        return new FailureResponse(400);
    }
}
