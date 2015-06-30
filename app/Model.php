<?php

namespace App;

abstract class Model
{
    /**
     * Magic method to get protected properties
     *
     * @param  string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        return null;
    }

    /**
     * Magic method to check if protected property is set
     *
     * @param  string $property
     *
     * @return boolean
     */
    public function __isset($property)
    {
        return property_exists($this, $property);
    }

    /**
     * Magic method to set protected properties
     *
     * @param  string $property
     * @param  mixed  $value
     *
     * @return void
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->{$property} = $value;
        }
    }
}
