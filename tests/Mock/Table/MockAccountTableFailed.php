<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Table;

use Stormannsgal\App\Entity\AccountCollection;
use Stormannsgal\App\Hydrator\AccountHydrator;
use Stormannsgal\App\Table\AccountTable;
use Stormannsgal\Core\Store\AccountStoreInterface;
use Stormannsgal\Mock\Database\MockQuery;

class MockAccountTableFailed extends AccountTable implements AccountStoreInterface
{
    public function __construct()
    {
        parent::__construct(
            new MockQuery(),
            new AccountHydrator(),
        );
    }

    public function findAll(): AccountCollection
    {
        return $this->hydrator->hydrateCollection([]);
    }
}
