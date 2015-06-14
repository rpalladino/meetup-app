<?php

namespace ChicagoPHP\MeetupApp\CheckIn;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use ChicagoPHP\MeetupApp\Event\Event;

class CheckInList implements IteratorAggregate, Countable
{
    private $checkIns;

    public static function forEvent(Event $event)
    {
        $checkInList = new CheckInList();
        $checkInList->checkIns = array_map(function ($rsvp) {
            return CheckIn::fromRSVP($rsvp);
        }, $event->getRSVPs());

        return $checkInList;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->checkIns);
    }

    public function count()
    {
        return count($this->checkIns);
    }
}
