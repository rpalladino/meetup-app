<?php

use App\CheckInList;
use App\CheckInsNotAllowedException;
use App\Event;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class EventOrganizerContext implements Context, SnippetAcceptingContext
{
    use EventDictionary;

    /**
     * @var RuntimeException
     */
    private $enableException;

    /**
     * @var DateTime;
     */
    private $onDate;

    /**
     * @Given the date is :date
     */
    public function theDateIs($date)
    {
        $this->onDate = new DateTime($date);
    }

    /**
     * @When I enable the check-in list for the event
     */
    public function iEnableTheCheckInListForTheEvent()
    {
        $this->checkInList = $this->checkInList ?: CheckInList::forEvent($this->event);

        try {
            $this->checkInList->enable($this->onDate);
        } catch (Exception $e) {
            $this->enableException = $e;
        }
    }

    /**
     * @Then I should see a message that check-ins for the event are not allowed
     */
    public function iShouldSeeAMessageThatCheckInsForTheEventAreNotAllowed()
    {
        expect($this->enableException)->toBeAnInstanceOf(CheckInsNotAllowedException::class);
    }
}
