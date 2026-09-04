<?php declare(strict_types=1);

namespace Stormannsgal\Game\Shared\Domain\Character;

use Stormannsgal\Game\Shared\Domain\Character\Enum\SkillCategory;

interface SkillInterface
{
    public int $id { get; }

    public string $name { get; }

    public string $description { get; }

    public SkillCategory $category { get; }

    public int $skillLevel { get; }
}
