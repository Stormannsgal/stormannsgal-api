<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character;

use Stormannsgal\Game\Shared\Domain\Character\Category\Combat\CombatInterface;

interface AbilitiesInterface
{
    public CombatInterface $combat { get; }
}
