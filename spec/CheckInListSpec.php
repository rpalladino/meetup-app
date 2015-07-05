<?php

namespace spec\App;

use App\Event;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckInListSpec extends ObjectBehavior
{
    function let()
    {
        $event = new Event();
        $this->beConstructedThrough('forEvent', [$event]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\CheckInList');
    }
}
