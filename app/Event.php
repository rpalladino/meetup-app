<?php

namespace App;

class Event extends Model
{
    /**
     * Event id
     *
     * @var string
     */
    protected $id;

    /**
     * Event name
     *
     * @var string
     */
    protected $name;

    /**
     * Event members
     *
     * @var array
     */
    protected $members;
}
