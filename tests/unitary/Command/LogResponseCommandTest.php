<?php

use Command\LogResponseCommand;

class LogResponseCommandTest extends PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Oops! App Kernel is not defined
     */
    public function testThrowAnExceptionWheneverExecutedWithoutKernel()
    {
        $this->clock = $this
            ->getMockBuilder('Component\Clock')
            ->disableOriginalConstructor()
            ->setMethods(['getMicroseconds'])
            ->getMock();

        $command = new LogResponseCommand(
            $this->clock
        );

        $command->execute($meta = []);
    }

    public function testNeedsKernelToBeExecuted()
    {
        $this->clock = $this
            ->getMockBuilder('Component\Clock')
            ->disableOriginalConstructor()
            ->setMethods(['getMicroseconds'])
            ->getMock();

        $this->response = $this
            ->getMockBuilder('Response\Response')
            ->disableOriginalConstructor()
            ->getMock();

        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();
        $this->kernel->expects($this->once())
            ->method('getResponse')
            ->willReturn($this->response);

        $this->app = $this
            ->getMockBuilder('Component\Application')
            ->disableOriginalConstructor()
            ->getMock();
        $this->app->expects($this->once())
            ->method('getKernel')
            ->with()
            ->willReturn($this->kernel);

        $command = new LogResponseCommand(
            $this->clock
        );

        $command->setKernel($this->app);

        $command->execute($meta = []);
    }
}
