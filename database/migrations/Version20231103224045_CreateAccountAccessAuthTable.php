<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\PrimaryKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20231103224045_CreateAccountAccessAuthTable extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $table = $schema->createTable('AccountAccessAuth');

        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true, 'unsigned' => true, 'comment' => 'Unique identifier of the access record']);
        $table->addColumn('accountId', Types::INTEGER, ['unsigned' => true, 'comment' => 'Account the access record belongs to']);
        $table->addColumn('label', Types::STRING, ['length' => 64, 'default' => 'default', 'comment' => 'Human-readable label for the session/device']);
        $table->addColumn('refreshToken', Types::STRING, ['length' => 512, 'comment' => 'Hashed refresh token used to issue new access tokens']);
        $table->addColumn('userAgent', Types::STRING, ['length' => 255, 'default' => 'unknown', 'comment' => 'User-Agent of the client that created the session']);
        $table->addColumn('clientIdentHash', Types::STRING, ['length' => 128, 'comment' => 'Hash identifying the client/browser session']);
        $table->addColumn('createdAt', Types::DATETIME_IMMUTABLE, ['default' => 'CURRENT_TIMESTAMP', 'comment' => 'Timestamp when the session was created']);

        $table->addPrimaryKeyConstraint(
            PrimaryKeyConstraint::editor()
                ->setUnquotedColumnNames('id')
                ->create()
        );
        $table->addUniqueIndex(['refreshToken'], 'account_access_auth_refresh_token_UNIQUE');
        $table->addUniqueIndex(['clientIdentHash'], 'account_access_auth_client_ident_hash_UNIQUE');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('AccountAccessAuth');
    }
}
