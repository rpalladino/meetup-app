<?php

require __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application([
    'debug' => true,
]);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/../resources/templates',
));

$app->get('/', 'App\Controllers\EventController::getEvent');

$app->run();
