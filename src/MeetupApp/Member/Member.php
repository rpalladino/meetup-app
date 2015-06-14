<?php

namespace ChicagoPHP\MeetupApp\Member;

class Member
{
    private $name;

    public static function named($name)
    {
        $member = new Member();
        $member->name = $name;

        return $member;
    }

    public function __toString()
    {
        return $this->name;
    }
}
