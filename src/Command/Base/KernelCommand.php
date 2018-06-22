<?php

namespace Command\Base;

use Component\Application;
use Component\Clock;

abstract class KernelCommand
{
    protected $app;

    protected $clock;

    public function __construct(
        Clock $clock
    ) {
        $this->clock = $clock;
    }

    public function setKernel(Application $app)
    {
        $this->app = $app;
    }

    public function getKernel()
    {
        if (!$this->app) {
            throw new \RuntimeException(
                'Oops! App Kernel is not defined'
            );
        }

        return $this->app->getKernel();
    }

    abstract public function execute($meta);
}
