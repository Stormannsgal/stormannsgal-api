<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20231103223745_CreateAccountTable extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('Account');

        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'comment' => 'Unique account identifier']);
        $table->addColumn('uuid', Types::GUID, ['comment' => 'Public account identifier used by the API']);
        $table->addColumn('name', Types::STRING, ['length' => 64, 'comment' => 'Unique display and login name']);
        $table->addColumn('password', Types::STRING, ['length' => 255, 'comment' => 'Bcrypt-hashed password']);
        $table->addColumn('email', Types::STRING, ['length' => 512, 'comment' => 'Email address used for login and notifications']);
        $table->addColumn('registeredAt', Types::DATETIME_IMMUTABLE, ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Timestamp when the account was registered']);
        $table->addColumn('lastActionAt', Types::DATETIME_IMMUTABLE, ['notnull' => false, 'comment' => 'Timestamp of the last recorded user activity']);

        $table->addPrimaryKeyConstraint(
            PrimaryKeyConstraint::editor()
                ->setUnquotedColumnNames('id')
                ->create()
        );
        $table->addUniqueIndex(['uuid'], 'account_uuid_UNIQUE');
        $table->addUniqueIndex(['name'], 'account_name_UNIQUE');
        $table->addUniqueIndex(['email'], 'account_email_UNIQUE');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('Account');
    }
}
