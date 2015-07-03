<?php

namespace App\Controllers;

use App\Contracts\Meetupable;

class EventController
{
    private $meetup;

    public function __construct(Meetupable $meetup)
    {
        $this->meetup = $meetup;
    }

    public function getEvent($eventId)
    {
        $event = $this->meetup->getEvent($eventId);
        $event->members = $this->meetup->getEventMembers($event->id);

        return ['event' => $event];
    }
}
