<?php

namespace Component;

use Command\LogRequestCommand;
use Command\LogResponseCommand;
use Command\PrintResponseCommand;
use Command\StoreRequestCommand;
use Objects\Config;
use Request\Request;
use Response\PubApi\GenericResponse;

/** @todo rename to httpflow */
class HttpKernel
{
    private static $events = [
        'request_received',
        'response_sent',
    ];

    private $request;

    private $response;

    private $app;

    private $router;

    public function __construct()
    {
        $this->app = new Application($this);
        $this->router = new Router(new Config());

        $this->router->protectRouteWith(new Security());

        $this->attach('request_received', StoreRequestCommand::class);
        $this->attach('request_received', LogRequestCommand::class);
        $this->attach('response_sent', PrintResponseCommand::class);
        $this->attach('response_sent', LogResponseCommand::class);
    }

    public function attach($event, $commandClass)
    {
        $this->app->attach($event, $commandClass);
    }

    /** @todo move events out from here */
    /** @todo define input events */
    /** @todo define output events */
    public function run(Request $request)
    {
        /** @todo store ordered lifecicle events */
        $this->app->dispatch('request_received', ['request' => $request]);
        $this->app->dispatch('response_sent', []);
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setResponse(GenericResponse $response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
