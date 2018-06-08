<?php

namespace Controller;

use Response\Response;

class RestController
{
    public function put()
    {
        return new Response([
            'class' => __CLASS__,
            'method' => __METHOD__,
        ], 200);
    }

    public function get()
    {
        return new Response([
            'class' => __CLASS__,
            'method' => __METHOD__,
        ], 200);
    }
}
