<?php

namespace Component;

use Objects\Route;

class Security
{
    public function headersAreInvalid()
    {
        /** @todo ask to a data provider // or other data layer */
        /** @todo if route security is not 'basic' throw an exception */

        return !isset($_SERVER['HTTP_AUTHORIZATION'])
            || $_SERVER['HTTP_AUTHORIZATION'] != 'Wheel Value';
    }

    public function headersOk()
    {
        return !$this->headersAreInvalid();
    }

    public function allow(Route $route)
    {
        return $route->isPublic()
            || (
                $route->isProtected()
                && $this->headersOk()
            );
    }
}
