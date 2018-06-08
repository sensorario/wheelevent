<?php

namespace Component;

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

        $this->events->attach(
            RequestEvent::class,
            new StoreRequestCommand($this)
        );

        $this->events->attach(
            ResponseEvent::class,
            new PrintResponseCommand($this)
        );
    }

    /** @todo move events out from here */
    /** @todo define input events */
    /** @todo define output events */
    public function run(Request $request)
    {
        $this->events->dispatch(
            RequestEvent::class,
            ['arguments' => ['request' => $request]]
        );

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
