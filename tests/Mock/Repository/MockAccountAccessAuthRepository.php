<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Repository;

use Stormannsgal\App\Repository\AccountAccessAuthRepository;
use Stormannsgal\Mock\Table\MockAccountAccessAuthTable;

readonly class MockAccountAccessAuthRepository extends AccountAccessAuthRepository
{

    public function __construct()
    {
        parent::__construct(new MockAccountAccessAuthTable());
    }

}
