<?php

namespace Command;

use Component\Dispatcher;

abstract class KernelCommand
{
    protected $dispatcher;

    public function setKernel(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function getKernel()
    {
        return $this->dispatcher->getKernel();
    }
}
