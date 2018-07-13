<?php

namespace Component;

use Objects\Route;

class Security
{
    public function headersAreInvalid()
    {
        /** @todo ask to a data provider // or other data layer */
        /** @todo if route security is not 'basic' throw an exception */

        $originale = $_SERVER['HTTP_AUTHORIZATION'];
        $ord = [];
        for ($i = 0; $i < strlen($originale); $i++) { $ord[] = ord($originale[$i]); }
        $ord = array_map(function($item) { return $item - 1; }, $ord);
        $stringa = '';
        for ($i = 0; $i < count($ord); $i ++) { $stringa .= chr($ord[$i]); }
        $json = json_decode($stringa);

        return $json->authenticated != true;
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
