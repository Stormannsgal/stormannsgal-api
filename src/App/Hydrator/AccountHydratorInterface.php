<?php declare(strict_types=1);

namespace Stormannsgal\App\Hydrator;

use Stormannsgal\Core\Entity\AccountCollectionInterface;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Hydrator\HydratorInterface;

interface AccountHydratorInterface extends HydratorInterface
{
    public function extract(AccountInterface $object): array;

    public function extractCollection(AccountCollectionInterface $collection): array;
}
