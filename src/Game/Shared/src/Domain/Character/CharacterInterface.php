<?php declare(strict_types=1);

namespace Game\Shared\Domain\Character;

use Game\Shared\Domain\Character\Enum\Gender;
use Ramsey\Uuid\UuidInterface;

interface CharacterInterface
{
    public ?int $id { get; }

    public UuidInterface $uuid { get; }

    public string $name { get; }

    public Gender $gender { get; }
}
