<?php

namespace spec\App;

use DateTime;
use App\Member;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Event');
    }

    function it_sets_and_retrieves_the_name()
    {
        $this->name = 'Help me code';
        $this->name->shouldBe('Help me code');
    }

    function it_sets_and_retrieves_the_date()
    {
        $this->date = new DateTime("July 1, 2015 7:00 PM");
        $this->date->shouldBeLike(new DateTime("July 1, 2015 7:00 PM"));
    }

    function it_has_zero_members_initially()
    {
        $this->members->shouldHaveCount(0);
    }

    function it_adds_members()
    {
        $this->addMember(new Member());
        $this->members->shouldHaveCount(1);
    }
}
