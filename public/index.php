<?php

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Component\HttpKernel();
$kernel->attach(Event\ResponseEvent::class, new Command\LogRequestCommand());
$kernel->run(new Request\Request());
