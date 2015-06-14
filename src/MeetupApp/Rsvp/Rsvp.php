<?php

namespace ChicagoPHP\MeetupApp\Rsvp;

use ChicagoPHP\MeetupApp\Member\Member;

class Rsvp
{
    private $member;
    
    public function __construct(Member $member, Response $response)
    {
        $this->member = $member;
    }

    public function getMember()
    {
        return $this->member;
    }
}
