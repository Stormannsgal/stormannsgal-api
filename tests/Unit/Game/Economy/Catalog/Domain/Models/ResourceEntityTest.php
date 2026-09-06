<?php declare(strict_types=1);

namespace Tests\Unit\Game\Economy\Catalog\Domain\Models;

use Game\Economy\Catalog\Api\Enum\ResourceCategory;
use Game\Economy\Catalog\Domain\Entities\Resource;
use InvalidArgumentException;

use function expect;
use function test;

test('creates valid resource entity and trims name', function (): void {
    $entity = new Resource('  Oak Wood  ', ResourceCategory::WOOD, 'oak_wood');

    expect($entity->name)->toBe('Oak Wood')
        ->and($entity->category)->toBe(ResourceCategory::WOOD)
        ->and($entity->identifier)->toBe('oak_wood');
});

test('property hook throws when name is empty', function (): void {
    expect(fn (): Resource => new Resource('   ', ResourceCategory::WOOD, 'oak_wood'))
        ->toThrow(InvalidArgumentException::class, 'Resource name cannot be empty.');
});

test('property hook throws when identifier is not snake_case', function (): void {
    expect(fn (): Resource => new Resource('Oak Wood', ResourceCategory::WOOD, 'Oak-Wood'))
        ->toThrow(InvalidArgumentException::class, 'Identifier must be snake_case (a-z, 0-9, _).');
});
