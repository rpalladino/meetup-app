<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use ChicagoPHP\MeetupApp\CheckIn\CheckInList;
use ChicagoPHP\MeetupApp\CheckIn\CheckedIn;
use ChicagoPHP\MeetupApp\Event\Event;
use ChicagoPHP\MeetupApp\Member\Member;
use ChicagoPHP\MeetupApp\Rsvp\Rsvp;
use ChicagoPHP\MeetupApp\Rsvp\YesResponse;


/**
 * Defines application features from the specific context.
 */
class AttendeeContext implements Context, SnippetAcceptingContext
{
    private $member;
    private $event;
    private $checkInList;
    private $selectedForCheckIn;

    /**
     * @Transform :response
     */
    public function transformStringToResponse($string)
    {
        if ("Yes" === $string) {
            return new YesResponse;
        }
    }
    
    /**
     * @Given I am a meetup member named :name
     */
    public function iAmAMeetupMemberNamed($name)
    {
        $this->member = Member::named($name);
    }

    /**
     * @Given I have RSVP'd :response for the event named :name
     */
    public function iHaveRsvpDForTheEventNamed($response, $name)
    {
        $rsvp = new Rsvp($this->member, $response);
        $this->event = Event::namedWithRSVPs($name, [$rsvp]);
    }

    /**
     * @Given I attend this event and go to check in
     */
    public function iAttendThisEventAndGoToCheckIn()
    {
        return; // no-op in this context
    }

    /**
     * @When I select myself from the check-in list for this event
     */
    public function iSelectMyselfFromTheCheckInListForThisEvent()
    {
        $this->checkInList = CheckInList::forEvent($this->event);
        foreach ($this->checkInList as $checkIn) {
            if ($checkIn->getMember() == $this->member) {
                $this->selectedForCheckIn = $checkIn->getMember();
            }
        }
    }

    /**
     * @When I confirm that I want to check in
     */
    public function iConfirmThatIWantToCheckIn()
    {
        $this->checkInList->checkIn($this->selectedForCheckIn);
    }

    /**
     * @Then I should see a message that I have successfuly checked in
     */
    public function iShouldSeeAMessageThatIHaveSuccessfulyCheckedIn()
    {
        $checkIn = $this->checkInList->findFor($this->member);
        expect($checkIn->getStatus())->toBeAnInstanceOf(CheckedIn::class);
    }

    /**
     * @Then I should see myself as checked-in for this event
     */
    public function iShouldSeeMyselfAsCheckedInForThisEvent()
    {
        throw new PendingException();
    }
}
