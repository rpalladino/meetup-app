<?php

namespace spec\App;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MemberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Member');
    }

    function it_sets_and_retrieves_the_name()
    {
        $this->name = 'John Smith';
        $this->name->shouldBe('John Smith');
    }
}
