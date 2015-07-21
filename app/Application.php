<?php

namespace App;

use App\Listeners\TwigRenderingListener;
use App\Providers\ControllersProvider;
use App\Providers\MeetupServiceProvider;
use Dotenv\Dotenv;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;

class Application extends \Silex\Application
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * {@inheritdoc}
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->basePath = __DIR__.'/..';

        $this->loadConfiguration();
        $this->registerProviders($this);
        $this->registerViewListeners($this);
    }

    /**
     * Load config for the environment
     */
    protected function loadConfiguration()
    {
        $dotenv = new Dotenv($this->basePath);
        $dotenv->load();
    }

    /**
     * Register service and controller providers
     *
     * @param  Application $app
     */
    protected function registerProviders(Application $app)
    {
        $app->register(new DoctrineServiceProvider(), [
            'db.options' => [
                'driver'   => 'pdo_sqlite',
                'path'     => $app->basePath.'/database/app.db',
            ],
        ]);

        $app->register(new TwigServiceProvider(), [
            'twig.path' => $app->basePath.'/resources/templates',
        ]);

        $app->register(new MeetupServiceProvider(), [
            'meetup.api_key' => getenv('MEETUP_API_KEY')
        ]);

        $app->register(new ServiceControllerServiceProvider());

        $app->register(new ControllersProvider());
    }

    /**
     * Register view listeners
     *
     * @param  Application $app
     */
    protected function registerViewListeners(Application $app)
    {
        $app->view(new TwigRenderingListener($app['twig']));
    }
}
