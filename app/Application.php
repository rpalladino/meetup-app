<?php

namespace App;

use App\Providers\MeetupServiceProvider;
use Dotenv\Dotenv;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;

class Application extends \Silex\Application
{
    private $rootPath;

    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->rootPath = __DIR__.'/..';

        $this->loadConfiguration();
        $this->registerProviders($this);
    }

    protected function loadConfiguration()
    {
        $dotenv = new Dotenv($this->rootPath);
        $dotenv->load();
    }

    protected function registerProviders(Application $app)
    {
        $app->register(new TwigServiceProvider(), [
          'twig.path' => $app->rootPath.'/resources/templates',
        ]);

        $app->register(new ServiceControllerServiceProvider());

        $app->register(new MeetupServiceProvider(), [
            'meetup.api_key' => getenv('MEETUP_API_KEY')
        ]);
    }
}
