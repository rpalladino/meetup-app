Feature: Attendee checks in
  In order to help the organizers track attendance at meetup events
  As a meetup attendee
  I need to be able to check in at a meetup

  Scenario: Successfully checking in at a meetup to which I RSVP'd Yes
    Given I am a meetup member named "John Smith"
    And I have RSVP'd "Yes" for the event named "Open Source Workshop"
    And I attend this event and go to check in
    When I select myself from the check-in list for this event
    And I confirm that I want to check in
    Then I should see a message that I have successfuly checked in
    And I should see myself as checked-in for this event
