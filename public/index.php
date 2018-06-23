<?php

require_once __DIR__ . '/../vendor/autoload.php';

$kernel = new Component\HttpKernel(
    new Component\Application()
);

$kernel->run(new Request\Request());
