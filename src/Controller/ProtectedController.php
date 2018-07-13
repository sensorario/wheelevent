<?php

namespace Controller;

use Response\Response;

class ProtectedController
{
    public function get()
    {
        return new Response([
            'class' => __CLASS__,
            'method' => __METHOD__,
        ], 200);
    }
}
