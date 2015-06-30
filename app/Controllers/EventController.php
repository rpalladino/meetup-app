<?php

namespace App\Controllers;

use App\Contracts\Meetupable;
use Silex\Application as App;
use Symfony\Component\HttpFoundation\Request;

class EventController
{
    public function getEvent(Request $request, App $app)
    {
        $eventId = $request->attributes->get('eventId');

        $event = $app[Meetupable::class]->getEvent($eventId);
        $event->members = $app[Meetupable::class]->getEventMembers($event->id);

        return $app['twig']->render('event.item.twig', ['event' => $event]);
    }
}
