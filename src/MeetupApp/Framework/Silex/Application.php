<?php

namespace ChicagoPHP\MeetupApp\Framework\Silex;

use Silex\Application as SilexApplication;

class Application extends SilexApplication
{
    public function __construct()
    {
        parent::__construct();
        
        $this->get('/', function () {
            return 'Hi!';
        });
    }
}
