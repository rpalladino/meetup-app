<?php

namespace App\Console;

use Pimple as Container;
use Symfony\Component\Console;

class Application extends Console\Application
{
    private $container;

    public function __construct(Container $container, $name, $version)
    {
        parent::__construct($name, $version);

        $this->container = $container;
    }
}
