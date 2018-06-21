<?php

namespace Component;

class Clock
{
    public function getMicroseconds()
    {
        return (new \DateTime('now'))
            ->format('Y-m-d H:i:s.u');
    }
}
