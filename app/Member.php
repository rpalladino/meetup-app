<?php

namespace App;

class Member extends Model
{
    /**
     * Member id
     *
     * @var string
     */
    protected $id;

    /**
     * Member name
     *
     * @var string
     */
    protected $name;

    /**
     * Member image url
     *
     * @var string
     */
    protected $picUrl;

    /**
     * Magic method to get protected properties
     *
     * @param  string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if ($property == 'picUrl' && !isset($this->picUrl)) {
            return '/images/default-avatar.png';
        }

        return parent::__get($property);
    }
}
