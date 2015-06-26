# Chicago PHP "Help Me Code"

The Chicago PHP UG is building an app that will track attendance of meetups and we're coding it together - with you!

## Getting started

### Clone this repository

To get started, fork this repository and then clone it locally:

```bash
$ git clone git@github.com:{you}/meetup-app.git
Cloning into 'meetup-app'...
remote: Counting objects: 36, done.
remote: Compressing objects: 100% (5/5), done.
remote: Total 36 (delta 0), reused 0 (delta 0), pack-reused 28
Receiving objects: 100% (36/36), 10.83 KiB | 0 bytes/s, done.
Resolving deltas: 100% (8/8), done.
Checking connectivity... done.
```

### Install dependencies with Composer

Then use [Composer](https://getcomposer.org/) to install dependencies from the project root directory:

```bash
$ cd meetup-app
$ composer install
```

Note: you may need to run `composer.phar` depending on how you have it installed.

### Run using PHP's built-in web server

The easiest way to run the app in development is with [PHP's built-in web server](http://php.net/manual/en/features.commandline.webserver.php). You can start it up with the following command:

```bash
$ php -S localhost:8000 -t web web/index.php
```


## Features 
- For the first iteration we're working on one feature: __allow members to check in at an event__. 
- Take a look at the [mockups](http://www.meetup.com/Chicago-PHP-User-Group/photos/26201975/) we made using [Balsamiq Mockups 3](https://balsamiq.com/products/mockups)
