<?php declare(strict_types=1);

namespace Game\Economy\Catalog\Domain\Entities;

use Game\Economy\Catalog\Api\Enum\ResourceCategory;
use InvalidArgumentException;

final class Resource
{
    // phpcs:disable PSR2.Classes.PropertyDeclaration, Generic.WhiteSpace.ScopeIndent
    private(set) string $name {
        set {
            $trimmedName = trim($value);
            if ($trimmedName === '') {
                throw new InvalidArgumentException('Resource name cannot be empty.');
            }

            $this->name = $trimmedName;
        }
    }

    private(set) string $identifier {
        set {
            if (!preg_match('/^[a-z0-9_]+$/', $value)) {
                throw new InvalidArgumentException('Identifier must be snake_case (a-z, 0-9, _).');
            }

            $this->identifier = $value;
        }
    }
    // phpcs:enable

    public function __construct(
        string $name,
        readonly public ResourceCategory $category,
        string $identifier,
    ) {
        $this->name = $name;
        $this->identifier = $identifier;
    }
}
