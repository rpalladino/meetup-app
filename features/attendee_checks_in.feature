Feature: Attendee checks in
    In order to help the organizers track attendance at meetup events
    As a meetup attendee
    I need to be able to check in at a meetup

    Background:
        Given there is an event named "Help me code" on "July 1"

    Scenario: Successfully check in at an event
        Given I RSVP'd "Yes" to the event
        And I attend the event and go to check in
        When I select myself from the check-in list for this event
        And I confirm that I want to check in
        Then I should see a message that I have successfully checked in
        And the check-in list should have 1 check-in
        And I should see myself as checked-in for this event

    Scenario: Unable to check in at event because did not RSVP
        Given I did not RSVP to the event
        When I attend the event and go to check in
        Then I should not see myself in the check-in list
