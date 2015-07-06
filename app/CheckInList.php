<?php

namespace App;

use App\Event;
use App\Member;
use DateTime;

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

    /**
     * @var Event
     */
    protected $event;

    public function __construct()
    {
        $this->checkIns = [];
        $this->members = [];
    }

    public static function forEvent(Event $event)
    {
        $checkInList = new self();
        $checkInList->event = $event;
        $checkInList->members = $event->members;

        return $checkInList;
    }

    public function enable(DateTime $onDate = null)
    {
        if (! isset($onDate)) {
            $onDate = new DateTime();
        }

        if ($this->event->date->format('Y-m-d') != $onDate->format('Y-m-d')) {
            throw new CheckInsNotAllowedException();
        }
    }

    public function checkIn(Member $member)
    {
        // TODO: write logic here
    }
}
