<?php

namespace spec\App\Meetup\RSVP;

use App\Meetup\Member;
use App\Meetup\RSVP\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RSVPSpec extends ObjectBehavior
{
    function let()
    {
        $member = Member::named('John Smith');
        $response = Response::fromString('yes');
        $this->beConstructedThrough('fromMemberWithResponse', [$member, $response]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Meetup\RSVP\RSVP');
    }
}
