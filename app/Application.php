<?php

namespace App;

use App\Listeners\TwigRenderingListener;
use App\Providers\MeetupServiceProvider;
use Dotenv\Dotenv;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;

class Application extends \Silex\Application
{
    private $basePath;

    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->basePath = __DIR__.'/..';

        $this->loadConfiguration();
        $this->registerProviders($this);
        $this->registerViewListeners($this);
    }

    protected function loadConfiguration()
    {
        $dotenv = new Dotenv($this->basePath);
        $dotenv->load();
    }

    protected function registerProviders(Application $app)
    {
        $app->register(new TwigServiceProvider(), [
          'twig.path' => $app->basePath.'/resources/templates',
        ]);

        $app->register(new ServiceControllerServiceProvider());

        $app->register(new MeetupServiceProvider(), [
            'meetup.api_key' => getenv('MEETUP_API_KEY')
        ]);
    }

    protected function registerViewListeners(Application $app)
    {
        $app->view(new TwigRenderingListener($app['twig']));
    }
}
