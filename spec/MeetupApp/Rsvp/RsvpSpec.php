<?php

namespace spec\ChicagoPHP\MeetupApp\Rsvp;

use ChicagoPHP\MeetupApp\Member\Member;
use ChicagoPHP\MeetupApp\Rsvp\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RsvpSpec extends ObjectBehavior
{
    function let(Member $member, Response $response)
    {
        $this->beConstructedWith($member, $response);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('ChicagoPHP\MeetupApp\Rsvp\Rsvp');
    }

    function it_can_get_the_member()
    {
        $this->getMember()->shouldBeAnInstanceOf(Member::class);
    }
}
