<?php declare(strict_types=1);

namespace Game\Location\Api\Enum;

enum LocationSubType: string
{
    case FOREST = 'forest';

    public function getTranslationKey(LocationType $parentType): string
    {
        return "location_type.{$parentType->value}.{$this->value}";
    }

    public function parentType(): LocationType
    {
        return match ($this) {
            self::FOREST => LocationType::WILDERNESS,
        };
    }
}
