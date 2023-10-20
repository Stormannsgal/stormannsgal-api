<?php declare(strict_types=1);

namespace Stormannsgal\Core\Utils;

use ArrayAccess;
use Closure;
use Countable;
use Iterator;
use JsonSerializable;
use Stormannsgal\Core\Exception\UndefinedOffsetException;

use function array_filter;
use function array_pop;
use function array_shift;
use function count;
use function is_null;
use function sprintf;

abstract class Collection implements Countable, ArrayAccess, Iterator, JsonSerializable
{
    /**
     * @param array<Collectible> $collection
     */
    protected array $collection = [];
    private int $position = 0;

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->collection[$offset]);
    }

    /**
     * @throws UndefinedOffsetException
     */
    public function offsetGet(mixed $offset): mixed
    {
        if (!array_key_exists($offset, $this->collection)) {
            throw new UndefinedOffsetException(
                sprintf('Undefined offset: %d in Collection %s on Line %s', $offset, __FILE__, __LINE__)
            );
        }

        return $this->collection[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->collection[] = $value;

            return;
        }
        $this->collection[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->collection[$offset]);
    }

    public function current(): mixed
    {
        return $this->collection[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function first(): mixed
    {
        $collection = $this->collection;
        return array_shift($collection);
    }

    public function last(): mixed
    {
        $collection = $this->collection;
        return array_pop($collection);
    }

    /**
     * @return array<Collectible>
     */
    public function filter(Closure $function): array
    {
        return array_filter($this->collection, $function);
    }

    public function getElements(): array
    {
        return $this->collection;
    }

    public function jsonSerialize(): array
    {
        return $this->getElements();
    }
}
