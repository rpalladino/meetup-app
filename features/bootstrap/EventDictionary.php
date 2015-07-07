<?php

use App\CheckInList;
use App\Event;
use App\Member;

/**
 * Defines application features from the specific context.
 */
trait EventDictionary
{
    /**
     * @var CheckInList;
     */
    protected $checkInList;

    /**
     * @var Event;
     */
    protected $event;

    /**
     * @Transform :member
     */
    public function transformStringToMember($string)
    {
        $member = new Member();
        $member->name = $string;

        return $member;
    }

    /**
     * @Transform :count
     */
    public function transformStringToInteger($string)
    {
        return (int) $string;
    }

    /**
     * @Given there is an event named :name on :date
     */
    public function thereIsAnEventNamedOn($name, $date)
    {
        $this->event = new Event();
        $this->event->name = $name;
        $this->event->date = new DateTime($date);
    }

    /**
     * @Given the member :member RSVP'd :rsvp to the event
     */
    public function theMemberRsvpDToTheEvent($member, $rsvp)
    {
        if ($rsvp === "Yes") {
            $this->event->addMember($member);
        }
    }

    /**
     * @Then the check-in list should have :count members
     */
    public function theCheckInListShouldHaveMembers($count)
    {
        expect($this->checkInList->members)->toHaveCount($count);
    }

    /**
     * @Then the check-in list should have :count check-in(s)
     */
    public function theCheckInListShouldHaveCheckIns($count)
    {
        expect($this->checkInList->checkIns)->toHaveCount($count);
    }
}
