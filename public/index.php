<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new HttpKernel())
    ->run(new Request());
