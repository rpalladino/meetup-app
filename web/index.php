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

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new App\Providers\MeetupServiceProvider(), [
    'meetup.api_key' => getenv('MEETUP_API_KEY')
]);

$app["app.home.controller"] = $app->share(function ($app) {
    return new App\Controllers\HomeController($app['twig']);
});
$app["app.event.controller"] = $app->share(function ($app) {
    return new App\Controllers\EventController($app['meetup.service'], $app['twig']);
});

$app->get('/', 'app.home.controller:getHome');
$app->get('/event/{eventId}', 'app.event.controller:getEvent');

$app->run();
