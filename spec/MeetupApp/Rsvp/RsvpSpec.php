<?php

namespace spec\ChicagoPHP\MeetupApp\Rsvp;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RsvpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ChicagoPHP\MeetupApp\Rsvp\Rsvp');
    }
}
