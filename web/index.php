<?php

require __DIR__.'/../vendor/autoload.php';

use ChicagoPHP\MeetupApp\Framework\Silex;

$app = new Silex\Application([
    'debug' => true,
]);

$app->run();
