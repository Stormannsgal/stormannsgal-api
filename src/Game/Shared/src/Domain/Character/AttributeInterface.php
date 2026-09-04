<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character;

interface AttributeInterface
{
    public string $name { get; }

    public string $shortDescription { get; }

    public string $description { get; }
}
