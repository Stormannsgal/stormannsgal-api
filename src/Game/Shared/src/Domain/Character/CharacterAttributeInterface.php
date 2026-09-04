<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character;

interface CharacterAttributeInterface
{
    public AttributeInterface $strength { get; }

    public AttributeInterface $dexterity { get; }

    public AttributeInterface $constitution { get; }

    public AttributeInterface $intelligence { get; }

    public AttributeInterface $wisdom { get; }

    public AttributeInterface $charisma { get; }
}
