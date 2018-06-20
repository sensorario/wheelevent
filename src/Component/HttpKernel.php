<?php

namespace Component;

use Command\LogRequestCommand;
use Command\LogResponseCommand;
use Command\PrintResponseCommand;
use Command\StoreRequestCommand;
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

    private $dispatcher;

    private $router;

    public function __construct()
    {
        $this->dispatcher = new Dispatcher($this);
        $this->router = new Router();

        $this->router->protectRouteWith(new Security());

        $this->attach('request_received', new StoreRequestCommand());
        $this->attach('request_received', new LogRequestCommand());
        $this->attach('response_sent', new PrintResponseCommand());
        $this->attach('response_sent', new LogResponseCommand());
    }

    public function attach($event, $command)
    {
        $this->dispatcher->attach($event, $command);
    }

    /** @todo move events out from here */
    /** @todo define input events */
    /** @todo define output events */
    public function run(Request $request)
    {
        /** @todo store ordered lifecicle events */
        $this->dispatcher->dispatch('request_received', ['request' => $request]);
        $this->dispatcher->dispatch('response_sent', []);
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
