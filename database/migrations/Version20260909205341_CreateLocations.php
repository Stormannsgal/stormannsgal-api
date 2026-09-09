<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20260909205341_CreateLocations extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('Locations');
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true, 'comment' => 'Unique location identifier']);
        $table->addColumn('parentId', Types::INTEGER, ['unsigned' => true, 'notnull' => false, 'default' => null, 'comment' => 'Optional parent location id; locations can form a hierarchy']);
        $table->addColumn('name', Types::STRING, ['length' => 100, 'comment' => 'Short display name of the location']);
        $table->addColumn('type', Types::STRING, ['length' => 50, 'comment' => 'Type/category of the location']);
        $table->addColumn('description', Types::TEXT, ['notnull' => false, 'default' => null, 'comment' => 'Optional longer description of the location']);
        $table->addColumn('isSafeZone', Types::BOOLEAN, ['default' => false, 'comment' => 'Marks the location as a safe zone']);
        $table->addColumn('mapConfigFile', Types::STRING, ['length' => 100, 'notnull' => false, 'default' => null, 'comment' => 'Optional map configuration asset for the location']);

        $table->addPrimaryKeyConstraint(
            PrimaryKeyConstraint::editor()
                ->setUnquotedColumnNames('id')
                ->create()
        );

        $table->addForeignKeyConstraint(
            'Locations',
            ['parentId'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('Locations');
    }
}
