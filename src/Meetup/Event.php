<?php

namespace App\Meetup;

class Event
{
    private $rsvps;

    public function withRSVPs(array $rsvps)
    {
        $event = clone $this;
        $event->rsvps = $rsvps;

        return $event;
    }

    public function getRSVPs()
    {
        return $this->rsvps;
    }
}
