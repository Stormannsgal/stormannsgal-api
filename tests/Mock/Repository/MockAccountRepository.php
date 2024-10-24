<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Repository;

use Stormannsgal\App\Repository\AccountRepository;
use Stormannsgal\Mock\Table\MockAccountTable;

readonly class MockAccountRepository extends AccountRepository
{
    public function __construct()
    {
        parent::__construct(new MockAccountTable());
    }
}
