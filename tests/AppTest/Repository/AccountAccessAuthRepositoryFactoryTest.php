<?php declare(strict_types=1);

namespace AppTest\Repository;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Repository\AccountAccessAuthRepositoryFactory;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Core\Store\AccountAccessAuthStoreInterface;
use Stormannsgal\Mock\MockContainer;
use Stormannsgal\Mock\Table\MockAccountAccessAuthTable;

class AccountAccessAuthRepositoryFactoryTest extends TestCase
{
    public function testCanCreateAccountAccessAuthRepositoryInstance(): void
    {
        $container = new MockContainer();
        $container->add(AccountAccessAuthStoreInterface::class, new MockAccountAccessAuthTable());

        $accountAccessAuthRepository = (new AccountAccessAuthRepositoryFactory())($container);

        $this->assertInstanceOf(AccountAccessAuthRepositoryInterface::class, $accountAccessAuthRepository);
    }
}
