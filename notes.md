# Notes

If I remember correctly, we had the following three tables:

```
member
------
id
name
pic_url

member_event (check_in)
------------
member_id
event_id
checked_in_at

event
-----
id
title
```

## One approach for moving forward


We can replace things incrementally here:

- Replace hardcoded array in EventController with SQL query
    - Add migrations tool
    - Add a migration to create a member table
    - Add a Member object and a repository class for persisting Members in the database
    - Add a console command to load fixture data using nelmio/alice
    - Remove hardcoded array in EventController, add repository call
    - Modify template to get properties from object instead of aray (if necessary)
- Replace fake fixtures data with real data from meetup api
    - Add a console command that syncs members table with meetup group members
        - Meetup api call: /2/members
        - Syncing will be easy...or totally messy.
            - Creating new members is easy. We can determine the most recent 'joined' date in the database, then filter the api results on that date to create two sets: new and existing. Then we just insert any members in the set of new members.
            - Updating members would be messy.
                - There's no 'modified' field in the api results, so we can't filter on a date.
                - We'd have to manually compare member data from api with what we have locally.
                - Another approach would be to just clear all member data and reinsert it all. Is that too drastic?
                - We're not persisting that much data... only name and a photo url. Maybe these don't change much anyway, so we shouldn't worry about updating local data?
            - See https://developer.apple.com/library/mac/documentation/Cocoa/Conceptual/CoreData/Articles/cdImporting.html for some ideas?
- Use Doctrine for persistence
    - Add dependency on the ORM service provider
    - Configure Doctrine mappings
    - Modify migrations commands to be ORM-aware
    - Remove hardcoded SQL queries from repository


If we do the above, we'll have established a bunch of the infrastraucture we'll need, but we still will not have delivered the feature. That would require still more work:

- Add a table for RSVPs, sync this with meetup api.
- Add a table for events, sync this with the api.
- Add logic to EventController to automatically select the current event, or show next upcoming event. (need start date for an event)
    - We'll need a fixture for a currently occuring event...
    - If we have a currently occuring event, show the members with 'Yes' RSVPs for it.
    - etc.

## A BDD approach

The BDD approach is completely different. Instead of starting with the database and dealing with things like fixture libraries and such, we want to drive the app development using example scenarios that we can execute as tests. The scenario step definitions will do things that traditional fixtures would do, that is, setting up the database in a known state.

Instead of loading fixtures specified separately, we specify fixture data like this directly in the feature files. This way we only load data that we actually need and we see the specific context in which it is being used.

We also have two different 'contexts' for running these as tests: one for the domain, one for the web application. This way we can run (fast) integration tests that exercise our domain model, and (slow) system tets that exercise the web UI.


## A compromise approach

We're going to need migrations and fixtures no matter which approach we take. (We will need fixtures for exploratory testing and demonstration purposes.) I can make a pull request that adds the migrations and fixtures infrastructure. This pull request wouldn't implement any functionality beyond what's in the app now. it would, however, introduce the infrastructure we need for continued development, no matter which direction that development takes. I prefer introducing infrastructure at a later stage of development (after more thourough exploration of the domain model) but I understand this is a collaborative effort and I don't want to inflcit my preferences on everyone else!

### My plan

1. Make a pull request that:
    - Add a Console app and configures it to run Doctrine migrations

    - Add a migration to create the members table
    - Add fake member data using fixtures (specified in php)
    - Modify EventController to run query
2. Open an issue proposing to focus on features over infrastructure

### A problem

If I want to add a fixtures library, it seems like we need to add a Model and possibly an ORM.

Using Doctrine Data Fixtures in combinatino with Nelmio/Alice seems to be common. It looks like Doctrine is used as the runner, while Alice is used to specify the fixtures as yml. What runner features does Doctrine Fixtures offer? It's not totally clear...

Can we do this without a fixtures library? What would that look like?

- In the database/fixtures library, just put a php file like, `members.php` and have it return an array of the members data. Just copy it straight from EventController.
- Then add a command in our console app, maybe `db:fixtures:load` that gets the fixture data (by including `database/fixtures/members.php`) and then inserts it into the database table.
- Modify `EventController` to make a simple SQL query to get members.
- Maybe also add a `db:reset` command that drops the db schema and re-runs migrations (check rake tasks, and also what symfony or laravel do here)

**This would simply replace what we've already done with some infrastructure, but without actually making any decisions. Someone else building on it would continue making the same 'nondecisions' about architecture.**

### A new problem

If we simply replace existing functionality by adding infrastructure, we haven't addressed the architec   ing the Member model to the database
- A fixtures library for loading fixture data for our models

This replaces functionality, but makes decisions: where to put models, how to persist them using an ORM, a fixtures library.

How can I defend these decisions?

- We decided to use the Doctrine Migrations library, and there seemed to be some agreement that we'd eventually use Doctrine's ORM as well, so I went ahead and wired that up as well.
- While I was at it, I added fixtures using Doctrine Data Fixtures (which includes some commands for loading fixtures) and Nelmio\Alice (which lets you specify fixtures in yml). There are other fixture generators out there, but both of these play well with Doctrine ORM so it was an easy choice.
- I put the Model classes in a `src/` directory. I know we already have an `app/` directory, but my thinking is that we'd leave `app/` for framework/infrastructure code  and use `src/` for the domain code -- any objections to that?

### To do right now!!

Let's learn a little more about Doctrine Data Fixtures. Does it include console commands for loading the fixtures, or is that a mistaken impression? Do we need this lib, or is it enough to use Alice with some custom commands?

- So its the DoctrineFixturesBundle that actually adds the commands. So we don't need to use DoctrineFixtures at all. It would just add another layer here.

- FActory Muffin actually looks awesome from a testing perspective. Maybe we should be using this instead of Alice? Maybe specifying fixture data in yml isn't necessary? See http://culttt.com/2013/05/27/laravel-4-fixture-replacement-with-factorymuff/. You define factories as php files (under `database\factories`) and then FactoryMuffin can load those up. Oh! Is it assuming active record models for persistence?? It defintely looks like it... You could call the setCustomSaver() and setCustomDeleter() methods with a closure that encloses a Doctrine EM instance for using the ORM for persistence. That wouldn't be too much effort. Is it worth it?

- We're going to need an app/Console/Command/LoadDataFixturesCommand.php command.



PHP Fixures Generators

- phpleague/factorymuffin (loads from php, no built-in persistence but assumes active record calls to save() on the object)
- nelmio/alice (loads from yaml, built-in support for Doctrine ORM, can use custom persistence)
- doctrine/fixtures (requires Doctrine ORM)
- phactory (defined in php, supports pdo, writes to tables/no need for Model classes)


## What we've done
- Added a readme and license file in branch `readme`
- Added migrations in the `doctrine-migrations` branch
- Added very basic fixtures in the `fixtures` branch, not using any kind of generator library






## User stories

First, we need to identify the stories we need to deliver this feature:

- __Organizer allows attendee check-in__: In order to keep track of who attends meetup events, as a meetup group organizer, I need to allow attendees to check in at the event.
    - Organizer pulls up the event page on an tablet, etc.
    - This will have a feature file like:

Feature: Oragnizer enables check-ins at event

    In order to keep track of who attends meetup events
    As a meetup group organizer
    I need to enable attendees to check in at the event

    Rules:
        - Only members who have RSVP'd can check-in to an event
        - Check-ins are allowed only the day of an event

    Background:
        Given there is an event named "Help me code" on "July 1" at "7:00 PM"
        And the member "John Smith" RSVP'd "Yes" to "Help me code"
        And the member "Alice Black" RSVP'd "Yes" to "Help me code"
        And the member "Bob White" RSVP'd "No" to "Help me code"

    Scenario: Successfully enable check-ins for event
        Given the date is "July 1" at "6:45 PM"
        When I open the check-in list
        Then I should see the check-in list for "Help me code"
        And the check-in list should have 2 members
        And the check-in list should have 0 check-ins

    Scenario: Cannot enable check-ins too early
        Given the date is "July 1" at "6:44 PM"
        When I open the check-in list
        Then I should see a message that check-ins for "Help me code" are not yet allowed

    Scenario: No upcoming event
        Given the date is "July 2" at "7:00PM"
        When I open the check-in list
        Then I should see a message that there is no upcoming event

- __Attendee checks in__: In order to help the organizers track attendance at meetup events, as a meetup event attendee, I need to check in at the event.

Feature: Attendee checks in
    In order to help the organizers track attendance at meetup events
    As a meetup attendee
    I need to be able to check in at a meetup

    Background:
        Given there is an event named "Help me code" on "July 1" at "7:00 PM"
        And the member "John Smith" RSVP'd "Yes" to "Help me code"
        And the member "Alice Black" RSVP'd "Yes" to "Help me code"
        And the member "Bob White" RSVP'd "No" to "Help me code"

    Scenario: check in at an event
        Given there is an event named "Help me code" on "July 1" at "7:00 PM"
        And I am the member named "John Smith"
        And I have RSVP'd "Yes" to the event
        And I attend this event and go to check in
        When I select myself from the check-in list for this event
        And I confirm that I want to check in
        Then I should see a message that I have successfuly checked in
        And I should see myself as checked-in for this event

## Feature brainstorming

In the  mettups, we dove pretty quickly into writing code after having created our mockups. This is pretty understandable, but I think that there's a lot of complexity hidden beneath the simplicity of our mockups. We need to be a little more eplicit about all the features that are going to be required in order to complete the first iteration.

Feature set/theme: Member check-in

- **Organizer enables check-ins at event** The event organizer opens the check-in list on ipad/tablet/laptop at the event and sees the list of members who have RSVP'd to the event.

- **Member checks in at event** The member attends an event to which he RSVP'd and checks in by selecting his picture/name on the check-in list. After confirming that the member is checking in as the correct person, they should see a success message.

A hidden story: getting the RSVPs from meetup.com. Does this happen every time the check-in list is refreshed? Is it a scheduled/back-end job?


Feature: Check-in list contains all members who RSVP'd at meetup.com 

    In order to track attendance at meetup events
    As a meetup organizer
    I want the check-in list to contain all members who have RSVP'd at meetup.com within the last 5 minutes


## enable check-ins for event, or create attendance list for event

Trying to get the language right here... Let's describe this from Sammy's perspective.

On the day of an event, Sammy the Organizer arrives at the event venue. He takes out his iPad, and opens up the meetup app. He sees a list of scheduled events for the Chicago PHP User Group, sorted by their start date. First in the list he sees the event which is about to start. It is highlighted or colored distintively to indicate as much. Sammy clicks a link to open the attendance list for the event. He sees a list of all the members who have RSVP'd 'yes' to the event. He places the iPad on a stand or table near the enterance to the room, so that attendees can check-in as they arrive.

This is good. Should we distinguish between the list that attendees use for checking in, and the list that organizers view after the event? One allows interactions from users. The other is read-only (maybe not?). The one is a grid of photographs, optimized for touch-interface. The other is probably a tabule of names, rsvp responses, and attendance statuses. 

A CheckIn object should track a time (checkedInAt) and allow specifying a guest count (+1, +2, etc.).

The Meetup API has an attendance service. What does its attendance model look like?

{
	"member": {
		"id": 123,
		"name": "John Smith,
		"photo": {
			"thumb": "http://..."
		}
	},
	"rsvp": {
		"guests": 0,
		"response": "yes|no|maybe|waitlist|havent"
	},
	"status": "attended|absent|noshow"
}





## Revising the organizer scenario

```
Feature: Oragnizer creates attendance list for an event

    In order to keep track of who attends meetup events
    As a meetup organizer
    I need to create an attendance list for an event

    Rules:
        - The attendance list should contain members who RSVP'd to an event with a response of "Yes"
        - Check-ins are allowed only on the day of an event

    Background:
        Given there is an event named "Help me code" on "July 1"

    Scenario: Successfully enable check-ins for event
        Given the event has the following RSVPs:
            | name        | response |
            | John Smith  | Yes      |
            | Alice Black | No       |
            | Bob White   | Yes      |
        When I enable check-ins for the event on "July 1"
        Then the event check-in list should have 2 members
        And the event check-in list should include "John Smith"
        And the event check-in list should include "Bob White"
        And the event should have 0 checked-in members
```









        When I create the check-in list for the event

        => $checkInList = CheckInList::forEvent($event);
        
        # Maybe the above is encapsulated behind:
        => $event->createCheckInList();

        When I retrieve the check-in list for the event

        => $checkInList = $event->getCheckInList();


## Using meetup.com's RSVP stream

The meetup api includes an rsvp stream, which is available either over http or a websocket. 

It looks like there's also an undocumented, or possibly deprecated, checkins stream? See: https://github.com/meetup/must.js/blob/master/must.js

## Why am I stuck?

What's the hang up here? What am I stuck on? 

I am having issues developing the Ubiquitous Language. Part of the reason for that is that I'm not engaged in conversation with anyone. I don't have a domain expert. I am doing the best I can. 

So what is the specific trouble I'm having? I want the lanugage I use in my Gherkin feature file to match the code in the step definitions & class model as closely as possible. So a first problem is writing the scenario steps in a way that accurately captures all the concepts involved in what I'm trying to achieve. I suspect that I don't yet have a complete picture in my head of how the app is going to be used in practice. We have a single feature we want to implement, 'find your face', the attendee check-in feature. But there's some details left out...like how do we get to this page? So that's why I created the following narrative:

> On the day of an event, Sammy the Organizer arrives at the event venue. He takes out his iPad, and opens up the meetup app. He sees a list of scheduled events for the Chicago PHP User Group, sorted by their start date. First in the list he sees the event which is about to start. It is highlighted or colored distintively to indicate as much. Sammy clicks a link to open the attendance list for the event. He sees a list of all the members who have RSVP'd 'yes' to the event. He places the iPad on a stand or table near the enterance to the room, so that attendees can check-in as they arrive.

I am trying to decide on the right language here. What is the organizer doing? Enabling check-ins for event, or creating an attendance list for the event, or allowing attendees to checkin, or opening event check-ins? Let's look at my narrative; I say "open the attendance list for the event." 

We can split this problem into two sub problems: (1) what are the right nouns to use? (2) what are the right verbs? What are the entities involved, and what are the behaviors? 

Let's list the nouns in our domain. A lot of these can be taken straight form meetup.com!

-  Group
-  Members
-  Organizers
-  Events
-  RSVPs
-  Attendance

What are some ways that we can or should talk about these terms?

- A group has many members
- A group has one or more organizer
- A group puts on events
- Members RSVP to events
- Organizers take attendance at events
- Organizers can retrieve an attendance list for an event

So far this is specifically meetup.com's domain, not ours. What does our app do?

- Organizers open checkins at an event
- Members check into an event

That's it. That's what came out most naturally. Let's see now if we can write the narrative for the first user story:

```
Feature: Organizers open checkins at an event
	In order to track attendance of meetup events
	As a meetup organizer
	I need to open checkins at an event
```

What I don't like about this is the mixed use of 'attendance' and 'checkins' in the purpose and feature parts of the narrative. Let's try some alternatives.

```
	In order to track attendance of meetup events
	As a meetup organizer
	I need to allow attendees to check in
```

This seems a little better, no? Why? Well, we have some symmetry of language with "attendance" and "attendee"; also we use "to check in" as a verb, i.e., a behavior, rather than as a thing, a "checkin". I prefer that. 

Let's try illustrating this story with some scenarios:

```
	Scenario: Allow attendees to check in
		Given there is an event named "Help me code"
		And the following members have RSVP'd to the event:
			| member_name | response |
			| John Smith  | yes      |
			| Alice White | no       |
			| Bob Black   | yes      |
		When I view the attendance list for the event
		Then the attendance list should have 2 members
		And the attendance list should include "John Smith"
		And the attendance list should include "Bob Black"
		And the attendance list should not include "Alice White"
		And the event should have 0 check-ins
		      
```

I like all of this, except the last part. It sounds natural to say "the event should have 0 check-ins" but what

