<?php

namespace Command;

class LogRequestCommand extends Base\KernelCommand implements PubApi\Command
{
    public function execute($meta)
    {
        $request = $meta['request'];
        $handle = fopen(__DIR__ . '/../../var/logs/request.log', 'a');
        $json = [
            'now'    => (new \DateTime())->format('Y-m-d H:i:s.u'),
            'method' => $request->getMethod(),
            'uri'    => $request->getUri(),
        ];
        fwrite($handle, json_encode($json) . "\n");
        fclose($handle);
    }
}
