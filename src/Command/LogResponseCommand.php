<?php

namespace Command;

class LogResponseCommand extends Base\KernelCommand implements PubApi\Command
{
    public function execute($meta)
    {
        $content = $this->getKernel()->getResponse()->getContent();
        $handle = fopen(__DIR__ . '/../../var/logs/response.log', 'a');
        fwrite($handle, json_encode([
            'now'    => (new \DateTime())->format('Y-m-d H:i:s.u'),
            'content' => json_decode($content),
        ]). "\n");
        fclose($handle);
    }
}
