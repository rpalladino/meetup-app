<?php

namespace App\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150626062001 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $membersTable = $schema->createTable('members');
        $membersTable->addColumn('id', 'integer', [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $membersTable->addColumn('name', 'string', ['length' => 60]);
        $membersTable->addColumn('photo_url', 'string', ['length' => 255]);
        $membersTable->setPrimaryKey(['id']);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('members');
    }
}
