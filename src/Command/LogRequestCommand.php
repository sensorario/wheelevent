<?php

namespace Command;

class LogRequestCommand extends Base\KernelCommand implements PubApi\Command
{
    private $message = null;

    public function execute($meta)
    {
        $this->buildMessage($meta);
        $this->writeMessage();
    }

    public function buildMessage($meta)
    {
        $request = $meta['request'];

        $now    = $this->clock->getMicroseconds();
        $method = $request->getMethod();
        $uri    = $request->getUri();

        $this->message = [
            'now'    => $now,
            'method' => $method,
            'uri'    => $uri,
        ];
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function writeMessage()
    {
        $handle = fopen(__DIR__ . '/../../var/logs/request.log', 'a');
        fwrite($handle, json_encode($this->getMessage()) . "\n");
        fclose($handle);
    }
}
