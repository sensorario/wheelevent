<?php

namespace Controller;

use Response\Response;
use Request\Request;

class AuthController
{
    public function post(Request $request)
    {
        if (
            /** @todo detect if credentials are valid */
            $request->getJson()->username == 'admin'
            && $request->getJson()->password == 'password'
        ) {
            /** @todo create cripted token */
            /** @todo define some different strategies */
            $json = json_encode($request->getJson());
            $ordCollection = [];
            for ($i = 0; $i < strlen($json); $i++) {
                $ordCollection[] = ord($json[$i]);
            }
            $ordCollection = array_map(function($item) {
                return $item + 1;
            }, $ordCollection);
            $token = '';
            for ($i = 0; $i < count($ordCollection); $i++) {
                $token .= chr($ordCollection[$i]);
            }

            return new Response([
                'token' => $token,
            ], 200);
        }

        return new Response([
            'code' => 403,
            'message' => 'wrong credentials',
        ], 403);
    }
}
