<?php declare(strict_types=1);

namespace AppTest\Repository;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Repository\AccountRepositoryFactory;
use Stormannsgal\Core\Repository\AccountRepositoryInterface;
use Stormannsgal\Core\Store\AccountStoreInterface;
use Stormannsgal\Mock\MockContainer;
use Stormannsgal\Mock\Table\MockAccountTable;

class AccountRepositoryFactoryTest extends TestCase
{
    public function testCanCreateAccountRepositoryInstance(): void
    {
        $container = new MockContainer();
        $container->add(AccountStoreInterface::class, new MockAccountTable());

        $accountRepository = (new AccountRepositoryFactory())($container);

        $this->assertInstanceOf(AccountRepositoryInterface::class, $accountRepository);
    }
}
