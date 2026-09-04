<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character;

use Ramsey\Uuid\UuidInterface;
use Stormannsgal\Game\Shared\Domain\Character\Enum\CharClass;
use Stormannsgal\Game\Shared\Domain\Character\Enum\Gender;

interface CharacterInterface
{
    public ?int $id { get; }

    public UuidInterface $uuid { get; }

    public string $name { get; }

    public Gender $gender { get; }

    public CharClass $class { get; }

    public CharacterAttributeInterface $attributes { get; }

    public AbilitiesInterface $abilities { get; }
}
