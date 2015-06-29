<?php

namespace App\Controllers;

use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;

class EventController
{
    public function getEvent(Request $request, App $app)
    {
        $members = $app["db"]->query("SELECT * FROM members")->fetchAll();

        return $app['twig']->render('event.item.twig', ['members' => $members]);
    }
}
