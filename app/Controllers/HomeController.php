<?php

namespace App\Controllers;

use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;

class HomeController
{
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getHome()
    {
        return $this->twig->render('home.twig');
    }
}
