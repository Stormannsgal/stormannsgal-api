<?php declare(strict_types=1);

namespace Game\Location\Api\Enum;

enum LocationType: string
{
    case WILDERNESS = 'wilderness';

    public function getTranslationKey(): string
    {
        return "location_type.{$this->value}.label";
    }
}
