<?php

namespace Component;

use Command\LogRequestCommand;
use Command\PrintResponseCommand;
use Command\StoreRequestCommand;
use Request\Request;

class HttpKernel
{
    private $request;

    private $events;

    private $router;

    public function __construct()
    {
        $this->events = new Dispatcher($this);
        $this->router = new Router();

        $this->router->protectRouteWith(new Security());

        $this->attach(RequestEvent::class, new StoreRequestCommand());
        $this->attach(RequestEvent::class, new LogRequestCommand());
        $this->attach(ResponseEvent::class, new PrintResponseCommand());
    }

    public function attach($event, $command)
    {
        $this->events->attach($event, $command);
    }

    /** @todo move events out from here */
    /** @todo define input events */
    /** @todo define output events */
    public function run(Request $request)
    {
        /** @todo store ordered lifecicle events */
        $this->events->dispatch(RequestEvent::class, ['request' => $request]);
        $this->events->dispatch(SecurityEvent::class, []);
        $this->events->dispatch(ResponseEvent::class, []);
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
}
