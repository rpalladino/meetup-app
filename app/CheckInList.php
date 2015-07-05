<?php

namespace App;

use App\Event;

class CheckInList
{
    public static function forEvent(Event $event)
    {
        $checkInList = new self();

        return $checkInList;
    }

    public function enable()
    {
        // TODO: write logic here
    }
}
