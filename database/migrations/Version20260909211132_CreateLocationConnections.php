<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20260909211132_CreateLocationConnections extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('LocationConnections');
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true, 'comment' => 'Unique identifier of the connection']);
        $table->addColumn('fromLocationId', Types::INTEGER, ['unsigned' => true, 'comment' => 'Source location id']);
        $table->addColumn('toLocationId', Types::INTEGER, ['unsigned' => true, 'comment' => 'Target location id']);
        $table->addColumn('name', Types::STRING, ['length' => 100, 'comment' => 'Display name of the connection']);
        $table->addColumn('isLocked', Types::BOOLEAN, ['default' => false, 'comment' => 'Whether the connection is currently locked']);
        $table->addColumn('requiredItemId', Types::INTEGER, ['unsigned' => true, 'notnull' => false, 'default' => null, 'comment' => 'Optional item required to traverse the connection']);
        $table->addColumn('requiredQuestId', Types::INTEGER, ['unsigned' => true, 'notnull' => false, 'default' => null, 'comment' => 'Optional quest required to traverse the connection']);
        $table->addColumn('minCharLevel', Types::INTEGER, ['unsigned' => true, 'default' => 1, 'comment' => 'Minimum character level required to traverse the connection']);

        $table->addPrimaryKeyConstraint(
            PrimaryKeyConstraint::editor()
                ->setUnquotedColumnNames('id')
                ->create()
        );
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('LocationConnections');
    }
}
