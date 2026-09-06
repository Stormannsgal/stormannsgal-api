<?php declare(strict_types=1);

namespace Game\Economy\Catalog\Api\DTO;

use Game\Economy\Catalog\Api\Enum\ResourceCategory;

readonly final class ResourceData
{
    public function __construct(
        public string $name,
        public ResourceCategory $category,
    ) {
    }
}
