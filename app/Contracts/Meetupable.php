<?php

namespace App\Contracts;

interface Meetupable
{
    public function getEvent($eventId);
    public function getEventMembers($eventId);
}
