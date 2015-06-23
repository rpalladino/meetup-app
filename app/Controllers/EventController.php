<?php

namespace App\Controllers;

use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;

class EventController
{
    public function getEvent(Request $request, App $app)
    {
        $members = [
            [
                'id' => '1',
                'name' => 'Foo Bar',
                'pic_url' => 'http://foo.com',
            ],[
                'id' => '2',
                'name' => 'Sea Shells',
                'pic_url' => 'http://foo.com',
            ],[
                'id' => '3',
                'name' => 'Code of Conduct Man',
                'pic_url' => 'http://foo.com',
            ],[
                'id' => '4',
                'name' => 'The elePHPant',
                'pic_url' => 'http://foo.com',
            ],[
                'id' => '5',
                'name' => 'David',
                'pic_url' => 'http://foo.com',
            ],
        ];

        return $app['twig']->render('event.item.twig', ['members' => $members]);
    }
}