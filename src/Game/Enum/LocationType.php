<?php declare(strict_types=1);

namespace Stormannsgal\Game\Enum;

enum LocationType: int
{
    case PLANET = 1;

    public function getLocationName(): string
    {
        return match ($this) {
            LocationType::PLANET => 'Planet'
        };
    }
}
