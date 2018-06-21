<?php

namespace Command\Base;

use Component\Dispatcher;
use Component\Clock;

abstract class KernelCommand
{
    protected $dispatcher;

    protected $clock;

    public function __construct(
        Clock $clock
    ) {
        $this->clock = $clock;
    }

    public function setKernel(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function getKernel()
    {
        return $this->dispatcher->getKernel();
    }
}
