<?php

namespace spec\App\Meetup;

use App\Meetup\Member;
use App\Meetup\RSVP\Response;
use App\Meetup\RSVP\RSVP;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Meetup\Event');
    }

    function it_can_be_immutably_modified_with_RSVPs()
    {
        $member = Member::named('John Smith');
        $response = Response::fromString('yes');
        $rsvps = [
            RSVP::fromMemberWithResponse($member, $response)
        ];

        $modified = $this->withRSVPs($rsvps);
        $modified->getRSVPs()->shouldHaveCount(1);

        $this->shouldNotBe($modified);
    }
}
