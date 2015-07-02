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

$controllers = new App\Providers\ControllersProvider();
$app->register($controllers);
$app->mount('/', $controllers);

$app->run();
