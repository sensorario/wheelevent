<?php

namespace Command;

class StoreRequestCommand extends KernelCommand implements Command
{
    public function execute($meta)
    {
        $arguments = $meta['arguments'];
        $request = $arguments['request'];
        $this->dispatcher->getKernel()->setRequest($request);
    }
}
