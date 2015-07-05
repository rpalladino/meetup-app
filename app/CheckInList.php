<?php

namespace App;

use App\Event;

class CheckInList extends Model
{
    protected $members;

    public static function forEvent(Event $event)
    {
        $checkInList = new self();
        $checkInList->members = $event->members;

        return $checkInList;
    }

    public function enable()
    {
        // TODO: write logic here
    }
}
