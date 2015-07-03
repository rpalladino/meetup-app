<?php

namespace App\Providers;

use App\Controllers;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;

class ControllersProvider implements ControllerProviderInterface, ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app["app.home.controller"] = $app->share(function ($app) {
            return new Controllers\HomeController($app['twig']);
        });
        $app["app.event.controller"] = $app->share(function ($app) {
            return new Controllers\EventController($app['meetup.service'], $app['twig']);
        });
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'app.home.controller:getHome')
                    ->value('template', 'home.twig');

        $controllers->get('/event/{eventId}', 'app.event.controller:getEvent')
                    ->value('template', 'event.item.twig');

        return $controllers;
    }

    public function boot(Application $app)
    {
        $app->mount('/', $this);
    }
}
