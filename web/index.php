<?php

require __DIR__.'/../vendor/autoload.php';

$app = new App\Application([
    'debug' => true,
]);

$controllers = new App\Providers\ControllersProvider();
$app->register($controllers);
$app->mount('/', $controllers);

$app->run();
