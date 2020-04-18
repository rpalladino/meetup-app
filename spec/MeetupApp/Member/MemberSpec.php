<?php

namespace spec\ChicagoPHP\MeetupApp\Member;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MemberSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough("named", ["John Smith"]);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('ChicagoPHP\MeetupApp\Member\Member');
    }

    function it_can_be_cast_to_string()
    {
        $this->__toString()->shouldReturn("John Smith");
    }
}