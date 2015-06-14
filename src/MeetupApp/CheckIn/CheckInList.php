<?php

namespace ChicagoPHP\MeetupApp\CheckIn;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use SplObjectStorage;
use ChicagoPHP\MeetupApp\Event\Event;
use ChicagoPHP\MeetupApp\Member\Member;

class CheckInList implements IteratorAggregate, Countable
{
    private $checkIns;

    public static function forEvent(Event $event)
    {
        $checkInList = new CheckInList();
        $checkInList->checkIns = new SplObjectStorage();
        
        foreach ($event->getRSVPs() as $rsvp) {
            $checkInList->checkIns->attach(CheckIn::fromRSVP($rsvp));
        }

        return $checkInList;
    }

    public function getIterator()
    {
        return $this->checkIns;
    }

    public function count()
    {
        return count($this->checkIns);
    }

    public function checkIn(Member $member)
    {
        $checkIn = $this->findFor($member);

        $this->checkIns->detach($checkIn);
        $this->checkIns->attach($checkIn->withStatus(new CheckedIn()));
    }

    public function findFor(Member $member)
    {
        foreach ($this->checkIns as $checkIn) {
            if ($checkIn->getMember() == $member) {
                return $checkIn;
            }
        }
    }
}
