<?php

namespace spec\ChicagoPHP\MeetupApp\CheckIn;

use ChicagoPHP\MeetupApp\CheckIn\CheckIn;
use ChicagoPHP\MeetupApp\CheckIn\CheckedIn;
use ChicagoPHP\MeetupApp\CheckIn\NotCheckedIn;
use ChicagoPHP\MeetupApp\CheckIn\Status;
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
        $this->shouldHaveType(CheckIn::class);
    }

    function it_can_retrieve_the_member()
    {
        $this->getMember()->shouldHaveType(Member::class);
    }

    function it_has_status_of_not_checked_in_by_default()
    {
        $this->getStatus()->shouldHaveType(NotCheckedIn::class);
    }

    function it_modifies_status_immutably(Status $status)
    {
        $modified = $this->withStatus($status);
        $modified->shouldHaveType(CheckIn::class);
        $this->shouldNotBe($modified);
    }
}
