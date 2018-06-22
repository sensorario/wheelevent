<?php

namespace Command;

class PrintResponseCommand extends Base\KernelCommand implements PubApi\Command
{
    public function execute($meta)
    {
        header('Content-type: application/json');
        header('X-Powered-By: sensorario/rest');

        $kernel = $this->getKernel();

        $router = $kernel->getRouter();
        $request = $kernel->getRequest();

        $response = $router->controller($request);
        http_response_code ($response->getHttpStatusCode());

        $this->app->getKernel()->setResponse($response);

        echo $response->getContent();
    }
}
