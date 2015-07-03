<?php

namespace App\Controllers;

use App\Contracts\Meetupable;

class EventController
{
    /**
     * @var Meetupable
     */
    private $meetup;

    public function __construct(Meetupable $meetup)
    {
        $this->meetup = $meetup;
    }

    /**
     * Get an event with RSVP'd members
     *
     * @param  string $eventId The meetup event id, e.g., 222497150
     *
     * @return array
     */
    public function getEvent($eventId)
    {
        $event = $this->meetup->getEvent($eventId);
        $event->members = $this->meetup->getEventMembers($event->id);

        return ['event' => $event];
    }
}
