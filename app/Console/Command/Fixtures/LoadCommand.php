<?php

namespace App\Console\Command\Fixtures;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LoadCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('fixtures:load')
            ->setDescription('Load data fixtures to the database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');
        $question = '<question>Database will be reset. Do you want to continue Y/N?</question>';

        if (! $dialog->askConfirmation($output, $question, false)) {
            return;
        }

        $this->loadMembers();
    }

    private function loadMembers()
    {
        $connection = $this->getHelperSet()->get('connection')->getConnection();
        $members = require __DIR__.'/../../../../database/fixtures/members.php';

        $connection->query("DELETE FROM members");

        $sql = "INSERT INTO members (id, name, photo_url)
                VALUES (:id, :name, :photo_url)";
        $statement = $connection->prepare($sql);

        foreach ($members as $member) {
            $statement->bindValue('id', $member['id']);
            $statement->bindValue('name', $member['name']);
            $statement->bindValue('photo_url', $member['photo_url']);
            $statement->execute();
        }
    }
}
