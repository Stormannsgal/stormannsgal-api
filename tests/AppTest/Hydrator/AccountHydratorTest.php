<?php declare(strict_types=1);

namespace AppTest\Hydrator;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Entity\AccountCollection;
use Stormannsgal\App\Hydrator\AccountHydrator;
use Stormannsgal\Core\Entity\AccountCollectionInterface;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Mock\Constants\Account;

class AccountHydratorTest extends TestCase
{
    public function testCanHydrateAccount(): void
    {
        $hydrator = new AccountHydrator();

        $account = $hydrator->hydrate(Account::VALID_DATA);

        $this->assertInstanceOf(AccountInterface::class, $account);
        $this->assertSame(Account::ID, $account->getId());
    }

    public function testCanHydrateAccountCollection(): void
    {
        $hydrator = new AccountHydrator();

        $accounts = $hydrator->hydrateCollection([Account::VALID_DATA]);

        $this->assertInstanceOf(AccountCollectionInterface::class, $accounts);
        $this->assertInstanceOf(AccountInterface::class, $accounts[0]);
        $this->assertSame(Account::ID, $accounts[0]->getId());
    }

    public function testCanExtractAccount(): void
    {
        $hydrator = new AccountHydrator();

        $account = $hydrator->hydrate(Account::VALID_DATA);
        $account = $hydrator->extract($account);

        $this->assertIsArray($account);
        $this->assertSame(Account::VALID_DATA, $account);
    }

    public function testCanExtractAccountCollection(): void
    {
        $hydrator = new AccountHydrator();
        $accounts = $hydrator->hydrateCollection([Account::VALID_DATA]);
        $accounts = $hydrator->extractCollection($accounts);

        $this->assertIsArray($accounts);
        $this->assertArrayHasKey(0, $accounts);
        $this->assertSame(Account::VALID_DATA, $accounts[0]);
    }
}
