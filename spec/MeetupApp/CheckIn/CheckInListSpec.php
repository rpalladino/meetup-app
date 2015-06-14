<?php

namespace spec\ChicagoPHP\MeetupApp\CheckIn;

use Countable;
use IteratorAggregate;
use ChicagoPHP\MeetupApp\CheckIn\CheckIn;
use ChicagoPHP\MeetupApp\CheckIn\CheckedIn;
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

    function it_can_check_in_a_member()
    {
        $member = Member::named("John Smith");
        
        $this->checkIn($member);

        $this->findFor($member)->getStatus()->shouldBeAnInstanceOf(CheckedIn::class);
    }

    function it_can_find_checkin_for_a_member()
    {
        $member = Member::named("John Smith");
        $this->findFor($member)->shouldBeAnInstanceOf(CheckIn::class);
    }
}
