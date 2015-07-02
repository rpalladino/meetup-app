<?php

namespace App\Controllers;

use App\Contracts\Meetupable;
use Twig_Environment;

class EventController
{
    private $meetup;
    private $twig;

    public function __construct(Meetupable $meetup, Twig_Environment $twig)
    {
        $this->meetup = $meetup;
        $this->twig = $twig;
    }

    public function getEvent($eventId)
    {
        $event = $this->meetup->getEvent($eventId);
        $event->members = $this->meetup->getEventMembers($event->id);

        return $this->twig->render('event.item.twig', ['event' => $event]);
    }
}
