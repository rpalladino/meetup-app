<?php

require __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application([
    'debug' => true,
]);

$app->get('/', function () {

    return 'Hi!';
});

$app->run();
