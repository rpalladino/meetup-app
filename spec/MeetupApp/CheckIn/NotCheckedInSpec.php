<?php

namespace spec\ChicagoPHP\MeetupApp\CheckIn;

use ChicagoPHP\MeetupApp\CheckIn\Status;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NotCheckedInSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldImplement(Status::class);
    }
}