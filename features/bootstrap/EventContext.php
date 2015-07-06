<?php

use App\CheckInList;
use App\CheckInsNotAllowedException;
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
    private $onDate;

    /**
     * @var CheckInList;
     */
    private $checkInList;

    /**
     * @var Exception
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
    public function theDateIs($date)
    {
        $this->onDate = new DateTime($date);
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
     * @When I enable the check-in list for the event
     */
    public function iEnableTheCheckInListForTheEvent()
    {
        $this->checkInList = CheckInList::forEvent($this->event);

        try {
            $this->checkInList->enable($this->onDate);
        } catch (Exception $e) {
            $this->checkInException = $e;
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

    /**
     * @Then I should see a message that check-ins for the event are not allowed
     */
    public function iShouldSeeAMessageThatCheckInsForTheEventAreNotAllowed()
    {
        expect($this->checkInException)->toBeAnInstanceOf(CheckInsNotAllowedException::class);
    }

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
        $this->onDate = $this->event->date;
        $this->iEnableTheCheckInListForTheEvent();
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
     * @Given I did not RSVP to the event
     */
    public function iDidNotRsvpToTheEvent()
    {
        $this->me = $this->transformStringToMember('John Smith');
    }

    /**
     * @Then I should not see myself in the check-in list
     */
    public function iShouldNotSeeMyselfInTheCheckInList()
    {
        expect($this->checkInList->members)->toNotContain($this->me);
    }

    /**
     * @Given I am checked-in for this event
     */
    public function iAmCheckedInForThisEvent()
    {
        $this->me = $this->transformStringToMember('John Smith');
        $this->iAttendTheEventAndGoToCheckIn();
        $this->iSelectMyselfFromTheCheckInListForThisEvent();
        $this->iConfirmThatIWantToCheckIn();
    }

    /**
     * @Then I should see a message that I am already checked in
     */
    public function iShouldSeeAMessageThatIAmAlreadyCheckedIn()
    {
        expect($this->checkInException)->toBeAnInstanceOf(MemberIsAlreadyCheckedInException::class);
    }
}
