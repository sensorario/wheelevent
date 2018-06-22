<?php

use Component\Dispatcher;

class DispatcherTest extends PHPUnit\Framework\TestCase
{
    public function testShouldInteractWithKernel()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $dispatcher = new Dispatcher(
            $this->kernel
        );

        $this->assertSame(
            $this->kernel,
            $dispatcher->getKernel()
        );
    }

    public function testShouldAttachCommandsToAnEvent()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $dispatcher = new Dispatcher(
            $this->kernel
        );

        $dispatcher->attach('event.name', Command\FooCommand::class);

        $expectedCommands = [
            Command\FooCommand::class
        ];

        $this->assertEquals(
            $expectedCommands,
            $dispatcher->eventsFor('event.name')
        );
    }

    public function testShouldDispatchEvents()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $dispatcher = new Dispatcher(
            $this->kernel
        );

        $dispatcher->attach('event.name', Command\FooCommand::class);

        $result = $dispatcher->dispatch('event.name', $meta = [ 'foo' => 'bar' ]);
        $this->assertEquals(true, $result);
    }

    public function testShouldNotDispatchEvents()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $dispatcher = new Dispatcher(
            $this->kernel
        );

        $result = $dispatcher->dispatch('event.name', $meta = [ 'foo' => 'bar' ]);
        $this->assertEquals(false, $result);
    }
}
