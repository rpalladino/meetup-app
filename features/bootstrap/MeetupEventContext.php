<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class MeetupEventContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given there is a meetup event with RSVPs:
     */
    public function thereIsAMeetupEventWithRsvps(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Given I am the member named :arg1
     */
    public function iAmTheMemberNamed($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I attend the event and go to check in
     */
    public function iAttendTheEventAndGoToCheckIn()
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1 on the check-in list
     */
    public function iShouldSeeOnTheCheckInList($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1 as not checked-in
     */
    public function iShouldSeeAsNotCheckedIn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I select :arg1 from the check-in list
     */
    public function iSelectFromTheCheckInList($arg1)
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
     * @Then I should see a message that :arg1 has successfully checked in
     */
    public function iShouldSeeAMessageThatHasSuccessfullyCheckedIn($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1 as checked-in on the check-in list
     */
    public function iShouldSeeAsCheckedInOnTheCheckInList($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should not see :arg1 on the check-in list
     */
    public function iShouldNotSeeOnTheCheckInList($arg1)
    {
        throw new PendingException();
    }
}
