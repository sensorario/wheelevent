<?php

namespace Controller;

use Response\Response;
use Request\Request;

class AuthController
{
    public function post(Request $request)
    {
        if (
            $request->getJson()->username == 'admin'
            && $request->getJson()->password == 'password'
        ) {
            $tokenObject = $request->getJson();
            $tokenObject->authenticated = true;

            $json = json_encode($tokenObject);
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
