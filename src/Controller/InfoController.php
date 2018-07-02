<?php

namespace Controller;

use Response\Response;

class InfoController
{
    public function get()
    {
        return new Response([
            'author' => 'Simone Gentili <sensorario@gmail.com>',
        ], 200);
    }
}
