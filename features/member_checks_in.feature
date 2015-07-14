Feature: Member checks in at event
    In order to help the organizers track attendance at meetup events
    As a meetup group member
    I need to be able to check in at a meetup

    Background:
        Given there is a meetup event with RSVPs:
            | member_name | response |
            | John Smith  | yes      |
            | Alice White | no       |

    Scenario: Successfully check in at an event
        Given I am the member named "John Smith"
        When I attend the event and go to check in
        Then I should see "John Smith" on the check-in list
        And I should see "John Smith" as not checked-in
        When I select "John Smith" from the check-in list
        And I confirm that I want to check in
        Then I should see a message that "John Smith" has successfully checked in
        And I should see "John Smith" as checked-in on the check-in list

    Scenario: Unable to check in at event becasue RSVP'd 'No'
        Given I am the member named "Alice White"
        When I attend the event and go to check in
        Then I should not see "Alice White" on the check-in list

    Scenario: Unable to check in at event because did not RSVP
        Given I am the member named "Bob Black"
        When I attend the event and go to check in
        Then I should not see "Bob Black" on the check-in list

