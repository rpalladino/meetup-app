<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Mink\Driver\BrowserKitDriver;
use Behat\Mink\Mink;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use ChicagoPHP\MeetupApp\Framework\Silex;
use Symfony\Component\HttpKernel\Client;

/**
 * Defines application features from the specific context.
 */
class WebAttendeeContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    private static $application;

    /**
     * @BeforeSuite
     */
    public static function initializeApplication()
    {
        self::$application = new Silex\Application();
    }

    /**
     * @BeforeScenario
     */
    public function initializeMink()
    {
        $driver = new BrowserKitDriver(new Client(self::$application));
        $mink = new Mink(['silex' => new Session($driver)]);
        $mink->setDefaultSessionName('silex');

        $this->setMink($mink);
    }

    /**
     * @AfterScenario
     */
    public function resetSessions()
    {
        $this->getMink()->resetSessions();
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
