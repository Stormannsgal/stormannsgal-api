<?php declare(strict_types=1);

namespace AppTest\Table;

use Envms\FluentPDO\Query;
use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydrator;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydratorInterface;
use Stormannsgal\App\Table\AccountAccessAuthTable;
use Stormannsgal\App\Table\AccountAccessAuthTableFactory;
use Stormannsgal\Mock\Database\MockQuery;
use Stormannsgal\Mock\MockContainer;

class AccountAccessAuthTableFactoryTest extends TestCase
{
    public function testCanCreateAccountAccesAuthTableInstance(): void
    {
        $container = new MockContainer();
        $container->add(Query::class, new MockQuery());
        $container->add(AccountAccessAuthHydratorInterface::class, new AccountAccessAuthHydrator());

        $accountAccessAuthTable = (new AccountAccessAuthTableFactory())($container);

        $this->assertInstanceOf(AccountAccessAuthTable::class, $accountAccessAuthTable);
    }
}
