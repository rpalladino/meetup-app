<?php

namespace App\Controllers;

use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{
    public function getHome(Request $request, App $app)
    {
        return $app['twig']->render('home.twig');
    }
}
