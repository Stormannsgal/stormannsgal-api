<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character;

use Ramsey\Uuid\UuidInterface;
use Game\Shared\Domain\Character\Enum\Gender;

interface CharacterInterface
{
    public ?int $id { get; }

    public UuidInterface $uuid { get; }

    public string $name { get; }

    public Gender $gender { get; }
}
