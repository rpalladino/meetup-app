<?php

namespace ChicagoPHP\MeetupApp\CheckIn;

use ChicagoPHP\MeetupApp\Rsvp\Rsvp;

class CheckIn
{
    private $member;
    
    public static function fromRSVP(Rsvp $rsvp)
    {
        $checkIn = new CheckIn();
        $checkIn->member = $rsvp->getMember();

        return $checkIn;
    }

    public function getMember()
    {
        return $this->member;
    }
}
