<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class WebAttendeeContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am a meetup member named :arg1
     */
    public function iAmAMeetupMemberNamed($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given I have RSVP'd :arg1 for the event named :arg2
     */
    public function iHaveRsvpDForTheEventNamed($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given I attend this event and go to check in
     */
    public function iAttendThisEventAndGoToCheckIn()
    {
        throw new PendingException();
    }

    /**
     * @When I select myself from the check-in list for this event
     */
    public function iSelectMyselfFromTheCheckInListForThisEvent()
    {
        throw new PendingException();
    }

    /**
     * @When I confirm that I want to check in
     */
    public function iConfirmThatIWantToCheckIn()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see a message that I have successfuly checked in
     */
    public function iShouldSeeAMessageThatIHaveSuccessfulyCheckedIn()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see myself as checked-in for this event
     */
    public function iShouldSeeMyselfAsCheckedInForThisEvent()
    {
        throw new PendingException();
    }
}
