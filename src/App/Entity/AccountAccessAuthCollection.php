<?php declare(strict_types=1);

namespace Stormannsgal\App\Entity;

use InvalidArgumentException;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Utils\Collection;

use function get_class;
use function sprintf;

class AccountAccessAuthCollection extends Collection implements AccountAccessAuthCollectionInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!($value instanceof AccountAccessAuthInterface)) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s must be an instance of %s',
                    get_class($value),
                    AccountAccessAuthInterface::class
                )
            );
        }
        parent::offsetSet($offset, $value);
    }
}
