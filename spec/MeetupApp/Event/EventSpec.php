<?php

namespace spec\ChicagoPHP\MeetupApp\Event;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ChicagoPHP\MeetupApp\Member\Member;
use ChicagoPHP\MeetupApp\Rsvp\Rsvp;
use ChicagoPHP\MeetupApp\Rsvp\YesResponse;

class EventSpec extends ObjectBehavior
{
    function let()
    {
        $name = "Open Source Workshop";
        $rsvps = [new Rsvp(Member::named("John Smith"), new YesResponse())];

        $this->beConstructedThrough("namedWithRSVPs", [$name, $rsvps]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('ChicagoPHP\MeetupApp\Event\Event');
    }
}
