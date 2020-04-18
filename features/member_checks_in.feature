Feature: Member checks in

    In order to help the organizers track attendance at meetup events
    As a meetup group member
    I need to be able to check in at a meetup

    Background:
        Given there is an event
        And I am the member named "John Smith"

    Scenario: Successfully check in at an event
        Given I RSVP'd "Yes" to the event
        When I attend the event and go to check in
        Then I should see "John Smith" on the check-in list
        And I should see "John Smith" as not checked-in
        When I select "John Smith" from the check-in list for this event
        And I confirm that I want to check in
        Then I should see a message that "John Smith" has successfully checked in
        And I should see "John Smith" as checked-in for this event

    Scenario: Unable to check in at event because member RSVP'd 'No'
        Given I RSVP'd "No" to the event
        When I attend the event and go to check in
        Then I should not see "John Smith" on the check-in list

    Scenario: Unable to check in because member did not RSVP
        Given I did not RSVP to the event
        When I attend the event and go to check in
        Then I should not see "John Smith" in the check-in list

    Scenario: Unable to check in twice
        Given I am checked-in for this event
        When I attend the event and go to check in
        And I select "John Smith" from the check-in list for this event
        And I confirm that I want to check in
        Then I should see a message that I am already checked in
