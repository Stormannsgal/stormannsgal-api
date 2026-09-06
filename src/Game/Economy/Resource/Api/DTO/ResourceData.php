<?php declare(strict_types=1);

namespace Game\Economy\Resource\Api\DTO;

use Game\Economy\Resource\Api\Enum\ResourceCategory;

readonly final class ResourceData
{
    public function __construct(
        public string $name,
        public ResourceCategory $category,
    ) {
    }
}
