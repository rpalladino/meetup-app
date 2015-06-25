<?php

namespace App;

use Silex;

class Application extends Silex\Application
{
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->register(new Silex\Provider\TwigServiceProvider(), array(
          'twig.path' => __DIR__.'/../resources/templates',
        ));
    }
}
