<?php

namespace spec\App;

use App\Event;
use App\Member;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckInListSpec extends ObjectBehavior
{
    function let()
    {
        $event = new Event();
        $event->addMember(new Member());
        $this->beConstructedThrough('forEvent', [$event]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\CheckInList');
    }

    function it_allows_to_be_enabled()
    {
        $this->enable();
    }

    function it_counts_members()
    {
        $this->members->shouldHaveCount(1);
    }
}
