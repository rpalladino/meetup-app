<?php

require __DIR__.'/../vendor/autoload.php';

$app = new App\Application([
    'debug' => true,
]);

$app->get('/', 'App\Controllers\EventController::getEvent');

$app->run();
