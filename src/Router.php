<?php

class Router
{
    public function controller($request)
    {
        $uris = [[
            'path' => '/',
            'controller' => RestController::class,
        ]];

        foreach ($uris as $endpoint) {
            if ($endpoint['path'] === $request->getUri()) {
                $controller = new $endpoint['controller']();
                if (method_exists($controller, $request->getMethod())) {
                    return $controller->{$request->getMethod()}();
                }
            }
        }

        return new FailureResponse(400);
    }
}
