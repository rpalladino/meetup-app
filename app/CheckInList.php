<?php

namespace App;

use App\Event;

class CheckInList extends Model
{
    /**
     * @var array
     */
    protected $checkIns;

    /**
     * @var array
     */
    protected $members;

    public function __construct()
    {
        $this->checkIns = [];
        $this->members = [];
    }

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
