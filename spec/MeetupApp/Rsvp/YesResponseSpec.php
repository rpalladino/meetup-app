<?php

namespace spec\ChicagoPHP\MeetupApp\Rsvp;

use ChicagoPHP\MeetupApp\Rsvp\Response;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class YesResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(Response::class);
    }
}
