<?php

class PrintResponseCommand extends KernelCommand implements Command
{
    public function execute($meta)
    {
        header('Content-type: application/json');
        header('X-Powered-By: sensorario/rest');

        $kernel = $this->getKernel();

        $router = $kernel->getRouter();
        $request = $kernel->getRequest();

        $response = $router->controller($request->getUri());
        http_response_code ($response->getHttpStatusCode());
        echo $response->getContent();
    }
}
