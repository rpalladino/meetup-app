<?php

namespace ChicagoPHP\MeetupApp\CheckIn;

use ChicagoPHP\MeetupApp\CheckIn\Status;
use ChicagoPHP\MeetupApp\Rsvp\Rsvp;

class CheckIn
{
    private $member;
    private $status;
    
    public static function fromRSVP(Rsvp $rsvp)
    {
        $checkIn = new CheckIn();
        $checkIn->member = $rsvp->getMember();
        $checkIn->status = new NotCheckedIn();

        return $checkIn;
    }

    public function getMember()
    {
        return $this->member;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function withStatus(Status $status)
    {
        $checkIn = clone $this;
        $checkIn->status = $status;

        return $checkIn;
    }
}
