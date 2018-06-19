<?php

namespace Component;

use Command\PubApi\Command;

class Dispatcher
{
    private $watcher = [];

    private $kernel;

    public function __construct(HttpKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function attach($event, Command $observer)
    {
        $this->watcher[$event][] = $observer;
    }

    public function dispatch($event, $meta)
    {
        if (!isset($this->watcher[$event])) { return; }

        foreach ($this->watcher[$event] as $observer) {
            $observer->setKernel($this);
            $observer->execute($meta);
        }
    }

    public function getKernel()
    {
        return $this->kernel;
    }
}
