<?php

use Command\LogRequestCommand;

class LogRequestCommandTest extends PHPUnit\Framework\TestCase
{
    public function testShouldBuildMessageUsingClockAndMeta()
    {
        $this->request = $this
            ->getMockBuilder('Request\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $this->request->expects($this->once())
            ->method('getMethod')
            ->willReturn($method = 'get');
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($uri = '/foo/bar');

        $this->clock = $this
            ->getMockBuilder('Component\Clock')
            ->disableOriginalConstructor()
            ->setMethods(['getMicroseconds'])
            ->getMock();
        $this->clock->expects($this->once())
            ->method('getMicroseconds')
            ->willReturn(
                $now = (new \DateTime('now'))
                ->format('Y-m-d H:i:s.u')
            );

        $command = new LogRequestCommand(
            $this->clock
        );

        $command->execute($meta = [
            'request' => $this->request
        ]);

        $this->assertEquals([
            'now'    => $now,
            'method' => $method,
            'uri'    => $uri,
        ], $command->getMessage());
    }
}
