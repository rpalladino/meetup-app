Feature: Oragnizer enables check-ins at event

    In order to keep track of who attends meetup events
    As a meetup organizer
    I need to enable attendees to check in at the event

    Rules:
        - Organizer opens the check-in list on a laptop/tablet at the event
        - Only members who have RSVP'd can check-in to an event
        - Check-ins are allowed only the day of an event

    Background:
        Given there is an event named "Help me code" on "July 1" at "7:00 PM"

    Scenario: Successfully enable check-ins for event
        Given the date is "July 1" at "6:45 PM"
        And the member "John Smith" RSVP'd "Yes" to the event
        And the member "Alice Black" RSVP'd "Yes" to the event
        And the member "Bob White" RSVP'd "No" to the event
        When I open the check-in list
        Then I should see the check-in list for the event
        And the check-in list should have 2 members
        And the check-in list should have 0 check-ins

    Scenario: Cannot enable check-ins too early
        Given the date is "June 30" at "7:00 PM"
        When I open the check-in list
        Then I should see a message that check-ins for "Help me code" are not yet allowed

    Scenario: No upcoming event
        Given the date is "July 2" at "7:00PM"
        When I open the check-in list
        Then I should see a message that there is no upcoming event
