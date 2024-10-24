<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Table;

use Stormannsgal\App\Hydrator\AccountAccessAuthHydrator;
use Stormannsgal\App\Table\AccountAccessAuthTable;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Store\AccountAccessAuthStoreInterface;
use Stormannsgal\Mock\Database\MockQuery;

class MockAccountAccessAuthTableFailed extends AccountAccessAuthTable implements AccountAccessAuthStoreInterface
{
    public function __construct()
    {
        parent::__construct(
            new MockQuery(),
            new AccountAccessAuthHydrator(),
        );
    }

    public function findAll(): AccountAccessAuthCollectionInterface
    {
        return $this->hydrator->hydrateCollection([]);
    }
}
