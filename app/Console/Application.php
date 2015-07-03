<?php

namespace App\Console;

use Doctrine\DBAL\Migrations\Tools\Console\Command as Migrations;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Pimple as Container;
use Symfony\Component\Console;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\DialogHelper;

class Application extends Console\Application
{
    private $container;

    public function __construct(Container $container, $name, $version)
    {
        parent::__construct($name, $version);

        $this->container = $container;

        $this->setHelperSet(new HelperSet([
            'connection' => new ConnectionHelper($this->container['db']),
            'dialog'     => new DialogHelper(),
        ]));

        $this->addCommands($this->getMigrationsCommands());
    }

    /**
     * Gets the commands provided by Doctrine Migrations
     *
     * @return array An array of Migrations Command instances
     */
    public function getMigrationsCommands()
    {
        return [
            new Migrations\ExecuteCommand(),
            new Migrations\GenerateCommand(),
            new Migrations\MigrateCommand(),
            new Migrations\StatusCommand(),
            new Migrations\VersionCommand()
        ];
    }
}
