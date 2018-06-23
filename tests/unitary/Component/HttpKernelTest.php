<?php

use Component\HttpKernel;

class HttpKernelTest extends PHPUnit\Framework\TestCase
{
    public function testShouldWorkWithAnApplication()
    {
        $this->request = $this
            ->getMockBuilder('Request\Request')
            ->disableOriginalConstructor()
            ->getMock();

        $this->app = $this
            ->getMockBuilder('Component\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $kernel = new HttpKernel($this->app);

        $this->assertEquals(true, true);
    }
}
