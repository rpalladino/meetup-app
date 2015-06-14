<?php

namespace ChicagoPHP\MeetupApp\Event;

class Event
{
    private $rsvps;

    public static function namedWithRSVPs($name, array $rsvps)
    {
        $event = new Event();
        $event->rsvps = $rsvps;

        return $event;
    }

    public function getRSVPs()
    {
        return $this->rsvps;
    }
}
