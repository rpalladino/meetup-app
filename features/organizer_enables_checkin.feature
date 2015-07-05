Feature: Oragnizer enables check-ins at event

    In order to keep track of who attends meetup events
    As a meetup organizer
    I need to enable attendees to check in at the event

    Rules:
        - Organizer enables the check-in list by opening it on a laptop/tablet at the event
        - Only members who have RSVP'd can check-in to an event
        - Check-ins are allowed only the day of an event

    Background:
        Given there is an event named "Help me code" on "July 1"

    Scenario: Successfully enable check-ins for event
        Given the date is "July 1"
        And the member "John Smith" RSVP'd "Yes" to the event
        And the member "Alice Black" RSVP'd "Yes" to the event
        And the member "Bob White" RSVP'd "No" to the event
        When I enable the check-in list for the event
        Then the check-in list should have 2 members
        And the check-in list should have 0 check-ins

    Scenario: Cannot enable check-ins before event date
        Given the date is "June 30"
        When I enable the check-in list
        Then I should see a message that check-ins for the event are not yet allowed

    Scenario: Cannot enable check-ins after event date
        Given the date is "July 2"
        When I enable the check-in list
        Then I should see a message that event are no longer allowed
