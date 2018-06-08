<?php

namespace Controller;

use Request\Request;
use Response\Response;

class RestController
{
    public function put(Request $request)
    {
        return new Response([
            'class' => __CLASS__,
            'method' => __METHOD__,
            'variables' => $request->getJson(),
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
