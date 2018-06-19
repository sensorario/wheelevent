<?php

return [

    [
        'path' => '/',
        'controller' => Controller\RestController::class,
    ],

    [
        'path' => '/info',
        'controller' => Controller\InfoController::class,
    ],

    [
        'path' => '/protected',
        'security' => 'basic',
        'controller' => Controller\ProtectedController::class,
    ],

];
