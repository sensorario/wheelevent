<?php

class InfoController
{
    public function get()
    {
        return new Response([
            'foo' => 'bar',
        ], 200);
    }
}
