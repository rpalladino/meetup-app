<?php

require __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

$app = new Silex\Application([
    'debug' => true,
]);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/../resources/templates',
));

$app[App\Contracts\Meetupable::class] = function () {
    return new App\Services\Meetup();
};

$app->get('/', 'App\Controllers\HomeController::getHome');
$app->get('/event/{eventId}', 'App\Controllers\EventController::getEvent');

$app->run();
