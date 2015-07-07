<?php

use App\CheckInList;
use App\MemberIsAlreadyCheckedInException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class EventAttendeeContext implements Context, SnippetAcceptingContext
{
    use EventDictionary;

    /**
     * @var RuntimeException
     */
    private $checkInException;

    /**
     * @var Member
     */
    private $me;

    /**
     * @var Member
     */
    private $selectedForCheckIn;

    /**
     * @Given I RSVP'd :rsvp to the event
     */
    public function iRsvpDToTheEvent($rsvp)
    {
        $this->me = $this->transformStringToMember('John Smith');
        $this->theMemberRsvpDToTheEvent($this->me, $rsvp);
    }

    /**
     * @Given I attend the event and go to check in
     */
    public function iAttendTheEventAndGoToCheckIn()
    {
        $this->checkInList = $this->checkInList ?: CheckInList::forEvent($this->event);
    }

    /**
     * @Given I did not RSVP to the event
     */
    public function iDidNotRsvpToTheEvent()
    {
        $this->me = $this->transformStringToMember('John Smith');
    }

    /**
     * @Given I am checked-in for this event
     */
    public function iAmCheckedInForThisEvent()
    {
        $this->iRsvpDToTheEvent("Yes");
        $this->iAttendTheEventAndGoToCheckIn();
        $this->iSelectMyselfFromTheCheckInListForThisEvent();
        $this->iConfirmThatIWantToCheckIn();
    }

    /**
     * @When I select myself from the check-in list for this event
     */
    public function iSelectMyselfFromTheCheckInListForThisEvent()
    {
        foreach ($this->checkInList->members as $member) {
            if ($member == $this->me) {
                $this->selectedForCheckIn = $member;
            }
        }
    }

    /**
     * @When I confirm that I want to check in
     */
    public function iConfirmThatIWantToCheckIn()
    {
        try {
            $this->checkInList->checkIn($this->selectedForCheckIn);
        } catch (Exception $e) {
            $this->checkInException = $e;
        }
    }

    /**
     * @Then I should see a message that I have successfully checked in
     */
    public function iShouldSeeAMessageThatIHaveSuccessfullyCheckedIn()
    {
        expect($this->checkInException)->shouldBe(null);
    }

    /**
     * @Then I should see myself as checked-in for this event
     */
    public function iShouldSeeMyselfAsCheckedInForThisEvent()
    {
        expect($this->checkInList->checkIns)->toContain($this->me);
    }

    /**
     * @Then I should not see myself in the check-in list
     */
    public function iShouldNotSeeMyselfInTheCheckInList()
    {
        expect($this->checkInList->members)->toNotContain($this->me);
    }

    /**
     * @Then I should see a message that I am already checked in
     */
    public function iShouldSeeAMessageThatIAmAlreadyCheckedIn()
    {
        expect($this->checkInException)->toBeAnInstanceOf(MemberIsAlreadyCheckedInException::class);
    }
}
