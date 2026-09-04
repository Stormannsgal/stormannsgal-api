<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character\Category\Combat;

interface CombatInterface
{
    public UnarmedCombatInterface $unarmedCombat { get; }
}
