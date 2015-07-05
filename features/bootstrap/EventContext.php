<?php

use App\CheckInList;
use App\Event;
use App\Member;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class EventContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Event;
     */
    private $event;

    /**
     * @var DateTime;
     */
    private $date;

    /**
     * @var CheckInList;
     */
    private $checkInList;

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
     * @Given the date is :date
     */
    public function theDateIsAt($date)
    {
        $this->date = new DateTime($date);
    }

    /**
     * @Given the member :member RSVP'd :rsvp to the event
     */
    public function theMemberRsvpDTo($member, $rsvp)
    {
        if ($rsvp === "Yes") {
            $this->event->addMember($member);
        }
    }

    /**
     * @When I enable the check-in list for the event
     */
    public function iEnableTheCheckInListForTheEvent()
    {
        $this->checkInList = CheckInList::forEvent($this->event);
        $this->checkInList->enable();
    }

    /**
     * @Then the check-in list should have :count members
     */
    public function theCheckInListShouldHaveMembers($count)
    {
        expect($this->checkInList->members)->toHaveCount($count);
    }

    /**
     * @Then the check-in list should have :arg1 check-ins
     */
    public function theCheckInListShouldHaveCheckIns($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a message that check-ins for :arg1 are not yet allowed
     */
    public function iShouldSeeAMessageThatCheckInsForAreNotYetAllowed($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a message that there is no upcoming event
     */
    public function iShouldSeeAMessageThatThereIsNoUpcomingEvent()
    {
        throw new PendingException();
    }
}
