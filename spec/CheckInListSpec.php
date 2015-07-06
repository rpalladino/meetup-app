<?php

namespace spec\App;

use App\CheckInsNotAllowedException;
use App\Event;
use App\Member;
use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckInListSpec extends ObjectBehavior
{
    function let()
    {
        $event = new Event();
        $event->date = new DateTime('July 1');
        $event->addMember(new Member());
        $this->beConstructedThrough('forEvent', [$event]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\CheckInList');
    }

    function it_allows_to_be_enabled()
    {
        $this->enable(new DateTime('July 1'));
    }

    function it_counts_members()
    {
        $this->members->shouldHaveCount(1);
    }

    function it_has_zero_checkins_initially()
    {
        $this->checkIns->shouldHaveCount(0);
    }

    function it_does_not_allow_to_be_enabled_before_event_date()
    {
        $date = new DateTime('June 30');
        $this->shouldThrow(CheckInsNotAllowedException::class)->duringEnable($date);
    }

    function it_checks_in_a_member(Member $member)
    {
        $this->checkIn($member);
        $this->checkIns->shouldHaveCount(1);
    }
}
