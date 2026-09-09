<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Game\Location\Api\Enum\LocationSubType;
use Game\Location\Api\Enum\LocationType;

final class Version20260909224409_InsertLocationData extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $locationType = [
            'forest' => LocationSubType::FOREST->getTranslationKey(LocationType::WILDERNESS),
        ];

        $sql = <<<SQL
              INSERT INTO `Locations` (`id`, `parentId`, `name`, `description`, `type`, `isSafeZone`, `mapConfigFile`) VALUES
                ('1', NULL, 'location.dark_forest.name', 'location.dark_forest.description', '{$locationType['forest']}', false, NULL);
        SQL;

        $this->addSql($sql);
    }

    public function down(Schema $schema): void
    {
        $sql = <<<SQL
              DELETE FROM `Locations`; 
        SQL;

        $this->addSql($sql);
    }
}
