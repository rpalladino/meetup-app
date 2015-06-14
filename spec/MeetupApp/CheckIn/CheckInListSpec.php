<?php

namespace spec\ChicagoPHP\MeetupApp\CheckIn;

use Countable;
use IteratorAggregate;
use ChicagoPHP\MeetupApp\Event\Event;
use ChicagoPHP\MeetupApp\Member\Member;
use ChicagoPHP\MeetupApp\Rsvp\Rsvp;
use ChicagoPHP\MeetupApp\Rsvp\YesResponse;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckInListSpec extends ObjectBehavior
{
    function let()
    {
        $name = "Open Source Workshop";
        $rsvp = new Rsvp(Member::named("John Smith"), new YesResponse());
        $event = Event::namedWithRSVPs($name, [$rsvp]);

        $this->beConstructedThrough("forEvent", [$event]);
    }

    function it_is_iterator_aggregate()
    {
        $this->shouldHaveType(IteratorAggregate::class);
    }

    function it_is_countable()
    {
        $this->shouldHaveType(Countable::class);
    }

    function it_has_checkin_for_each_rsvp()
    {
        $this->count()->shouldBe(1);
    }

    function it_can_check_in_a_member(Member $member)
    {
        $this->checkIn($member);
    }
}
