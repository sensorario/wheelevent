<?php

namespace Command;

class StoreRequestCommand extends Base\KernelCommand implements PubApi\Command
{
    public function execute($meta)
    {
        $request = $meta['request'];
        $this->app->getKernel()->setRequest($request);
    }
}
