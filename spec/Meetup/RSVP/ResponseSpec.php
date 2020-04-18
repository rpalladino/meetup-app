<?php

namespace spec\App\Meetup\RSVP;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResponseSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromString', ['yes']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Meetup\RSVP\Response');
    }
}
