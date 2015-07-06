<?php

namespace spec\App;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RuntimeException;

class CheckInsNotAllowedExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RuntimeException::class);
    }
}
