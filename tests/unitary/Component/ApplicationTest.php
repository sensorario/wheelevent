<?php

use Component\Application;

class ApplicationTest extends PHPUnit\Framework\TestCase
{
    public function testShouldInteractWithKernel()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $app = new Application(
            $this->kernel
        );

        $this->assertSame(
            $this->kernel,
            $app->getKernel()
        );
    }

    public function testShouldAttachCommandsToAnEvent()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $app = new Application(
            $this->kernel
        );

        $app->attach('event.name', Command\FooCommand::class);

        $expectedCommands = [
            Command\FooCommand::class
        ];

        $this->assertEquals(
            $expectedCommands,
            $app->eventsFor('event.name')
        );
    }

    public function testDispatchActionReturnTrueWheneverCommandsAreAttachedToAnEvent()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $app = new Application(
            $this->kernel
        );

        $app->attach('event.name', Command\FooCommand::class);

        $result = $app->dispatch('event.name', $meta = [ 'foo' => 'bar' ]);
        $this->assertEquals(true, $result);
    }

    public function testDispatchActionReturnFalseWheneverNoCommandsAreAttachedToAnEvent()
    {
        $this->kernel = $this
            ->getMockBuilder('Component\HttpKernel')
            ->disableOriginalConstructor()
            ->getMock();

        $app = new Application(
            $this->kernel
        );

        $result = $app->dispatch('event.name', $meta = [ 'foo' => 'bar' ]);
        $this->assertEquals(false, $result);
    }
}
