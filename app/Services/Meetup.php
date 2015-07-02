<?php

namespace App\Services;

use App\Event;
use App\Member;
use App\Contracts\Meetupable;
use DMS\Service\Meetup\MeetupKeyAuthClient;

class Meetup implements Meetupable
{
    /**
     * Create service instance
     */
    public function __construct(MeetupKeyAuthClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get information for given event
     *
     * @param  string $eventId
     *
     * @return App\Event
     */
    public function getEvent($eventId)
    {
        $response = $this->client->getEvent(['id' => $eventId]);

        return $this->makeEvent($response->getData());
    }

    /**
     * Get members from RSVPs for given event
     *
     * @param  string  $eventId
     *
     * @return array Collection of members
     */
    public function getEventMembers($eventId)
    {
        $response = $this->client->getRsvps(['event_id' => $eventId]);

        $members = [];

        array_map(function ($item) use (&$members) {
            $members[] = $this->makeMember($item);
        }, $response->getData());

        return $members;
    }

    /**
     * Create event from API response item
     *
     * @param  array $attributes
     *
     * @return App\Event
     */
    private function makeEvent($attributes = [])
    {
        $event = new Event;
        $event->id = $this->getNestedValue($attributes, 'id');
        $event->name = $this->getNestedValue($attributes, 'name');

        return $event;
    }

    /**
     * Create member from API response item
     *
     * @param  array $attributes
     *
     * @return App\Member
     */
    private function makeMember($attributes = [])
    {
        $member = new Member;
        $member->id = $this->getNestedValue($attributes, 'member.member_id');
        $member->name = $this->getNestedValue($attributes, 'member.name');
        $member->picUrl = $this->getNestedValue($attributes, 'member_photo.photo_link');

        return $member;
    }

    /**
     * Attempt to get nested value from array using dot syntax
     *
     * @param  array  $context
     * @param  string $name
     *
     * @return mixed
     */
    private function getNestedValue(&$context, $name)
    {
        $pieces = explode('.', $name);
        foreach ($pieces as $piece) {
            if (!is_array($context) || !array_key_exists($piece, $context)) {
                return null;
            }

            $context = &$context[$piece];
        }

        return $context;
    }
}
