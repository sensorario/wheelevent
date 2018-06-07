<?php

class Router
{
    public function controller($uri)
    {
        $uris = [[
            'path' => '/',
            'controller' => DefaultController::class,
            'action' => 'default',
        ]];

        foreach ($uris as $endpoint) {
            if ($endpoint['path'] === $uri) {
                $controller = new $endpoint['controller']();
                return $controller->{$endpoint['action']}();
            }
        }

        return new FailureResponse(400);
    }
}
