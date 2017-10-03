<?php

namespace XuplauMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171003204500 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $myTable = $schema->createTable('artists');
        $myTable->addColumn('id', 'integer',
            ['unsigned' => true, 'autoincrement'=>true]);
        $myTable->addColumn('name', 'string', ['length' => 60]);
        $myTable->setPrimaryKey(['id']);

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('artists');

    }
}
