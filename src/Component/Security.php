<?php

namespace Component;

use Objects\Route;

class Security
{
    public function containsValidHeaders()
    {
        /** @todo ask to a data provider // or other data layer */

        return !isset($_SERVER['HTTP_AUTHORIZATION'])
            || $_SERVER['HTTP_AUTHORIZATION'] != 'Wheel Value';
    }

    public function allow(Route $route)
    {
        return $route->isPublic()
            || (
                $route->isProtected()
                && !$this->containsValidHeaders()
            );
    }
}
