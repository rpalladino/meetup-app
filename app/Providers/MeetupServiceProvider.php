<?php

namespace App\Providers;

use App\Services\Meetup;
use DMS\Service\Meetup\MeetupKeyAuthClient;
use Silex\Application;
use Silex\ServiceProviderInterface;

class MeetupServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        $app['meetup.api_key'] = '';
        $app['meetup.client'] = $app->share(function ($app) {
            return MeetupKeyAuthClient::factory([
                'key' => $app['meetup.api_key'],
                'sign' => true
            ]);
        });
        $app['meetup.service'] = $app->share(function ($app) {
            return new Meetup($app['meetup.client']);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}
