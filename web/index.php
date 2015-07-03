<?php

require __DIR__.'/../vendor/autoload.php';

$app = new App\Application([
    'debug' => true,
]);

$app->run();
