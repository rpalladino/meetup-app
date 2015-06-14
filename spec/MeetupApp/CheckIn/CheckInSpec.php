<?php

namespace spec\ChicagoPHP\MeetupApp\CheckIn;

use ChicagoPHP\MeetupApp\Member\Member;
use ChicagoPHP\MeetupApp\Rsvp\Rsvp;
use ChicagoPHP\MeetupApp\Rsvp\YesResponse;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckInSpec extends ObjectBehavior
{
    function let()
    {
        $rsvp = new Rsvp(Member::named("John Smith"), new YesResponse());
        $this->beConstructedThrough("fromRSVP", [$rsvp]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('ChicagoPHP\MeetupApp\CheckIn\CheckIn');
    }

    function it_can_retrieve_the_member()
    {
        $this->getMember()->shouldHaveType(Member::class);
    }
}
