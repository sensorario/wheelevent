<?php

use Component\Security;
use Objects\Route;

class SecurityTest extends PHPUnit\Framework\TestCase
{
    public function testDetectPublicRoute()
    {
        $security = new Security();
        $allow = $security->allow(Route::fromArray([]));
        $this->assertEquals(true, $allow);
    }

    public function testDetectPrivateResourcesWheneverSecurityParameterIsDefined()
    {
        $security = new Security();
        $allow = $security->allow(Route::fromArray([
            'security' => true,
        ]));
        $this->assertEquals(false, $allow);
    }
}
