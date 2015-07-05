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
     * @Then I should see the check-in list for the event
     */
    public function iShouldSeeTheCheckInListForTheEvent()
    {
        throw new PendingException();
    }

    /**
     * @Then the check-in list should have :arg1 members
     */
    public function theCheckInListShouldHaveMembers($arg1)
    {
        throw new PendingException();
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
