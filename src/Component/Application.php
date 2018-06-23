<?php

namespace Component;

use Command\PubApi\Command;

class Application
{
    private $watcher = [];

    private $kernel;

    public function setKernel(HttpKernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function attach($event, $commandClass)
    {
        $this->watcher[$event][] = $commandClass;
    }

    public function dispatch($event, $meta)
    {
        if (!isset($this->watcher[$event])) {
            return false;
        }

        foreach ($this->watcher[$event] as $commandClass) {
            $observer = new $commandClass(
                new Clock()
            );

            $observer->setKernel($this);
            $observer->execute($meta);
        }

        return true;
    }

    public function getKernel()
    {
        return $this->kernel;
    }

    public function eventsFor(string $eventName)
    {
        return $this->watcher[$eventName];
    }
}
