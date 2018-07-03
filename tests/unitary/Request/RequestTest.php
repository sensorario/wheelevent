<?php

use Request\Request;

class RequestTest extends PHPUnit\Framework\TestCase
{
    public function testRequest()
    {
        $request = new Request([
            'REQUEST_URI' => '/info',
            'REQUEST_METHOD' => '',
        ]);

        $this->assertEquals('/info', $request->getUri());
    }
}
