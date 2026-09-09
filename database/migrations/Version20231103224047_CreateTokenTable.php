<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20231103224047_CreateTokenTable extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('Token');

        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true, 'comment' => 'Unique identifier of the token record']);
        $table->addColumn('accountId', Types::INTEGER, ['unsigned' => true, 'comment' => 'Account the token belongs to']);
        $table->addColumn('token', Types::GUID, ['comment' => 'Unique token value']);
        $table->addColumn('tokenType', Types::SMALLINT, ['unsigned' => true, 'length' => 2, 'comment' => 'Numeric type of the token']);
        $table->addColumn('createdAt', Types::DATETIME_IMMUTABLE, ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Timestamp when the token was created']);

        $table->addPrimaryKeyConstraint(
            PrimaryKeyConstraint::editor()
                ->setUnquotedColumnNames('id')
                ->create()
        );
        $table->addUniqueIndex(['token'], 'token_token_UNIQUE');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('Token');
    }
}
