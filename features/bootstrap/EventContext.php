<?php

use App\Event;
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
     * @Given there is an event named :name on :date at :time
     */
    public function thereIsAnEventNamedOnAt($name, $date, $time)
    {
        $this->event = new Event();
        $this->event->name = $name;
        $this->event->date = new DateTime($date.' '.$time);
    }

    /**
     * @Given the date is :arg1 at :arg2
     */
    public function theDateIsAt($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given the member :arg1 RSVP'd :arg2 to :arg3
     */
    public function theMemberRsvpDTo($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @When I open the check-in list
     */
    public function iOpenTheCheckInList()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the check-in list for :arg1
     */
    public function iShouldSeeTheCheckInListFor($arg1)
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
