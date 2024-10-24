<?php declare(strict_types=1);

namespace Stormannsgal\App\Hydrator;

use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Hydrator\HydratorInterface;

interface AccountAccessAuthHydratorInterface extends HydratorInterface
{
    public function extract(AccountAccessAuthInterface $object): array;

    public function extractCollection(AccountAccessAuthCollectionInterface $collection): array;
}
