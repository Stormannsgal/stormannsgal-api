<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Hydrator;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydrator;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Mock\Constants\AccountAccessAuth;

class AccountAccessAuthHydratorTest extends TestCase
{
    public function testCanHydrateAccountAccessAuth(): void
    {
        $hydrator = new AccountAccessAuthHydrator();

        $account = $hydrator->hydrate(AccountAccessAuth::VALID_DATA);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $account);
        $this->assertSame(AccountAccessAuth::ID, $account->getId());
    }

    public function testCanHydrateAccountAccessAuthCollection(): void
    {
        $hydrator = new AccountAccessAuthHydrator();

        $accounts = $hydrator->hydrateCollection([AccountAccessAuth::VALID_DATA]);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $accounts);
        $this->assertInstanceOf(AccountAccessAuthInterface::class, $accounts[0]);
        $this->assertSame(AccountAccessAuth::ID, $accounts[0]->getId());
    }

    public function testCanExtractAccountAccessAuth(): void
    {
        $hydrator = new AccountAccessAuthHydrator();

        $account = $hydrator->hydrate(AccountAccessAuth::VALID_DATA);
        $account = $hydrator->extract($account);

        $this->assertIsArray($account);
        $this->assertSame(AccountAccessAuth::VALID_DATA, $account);
    }

    public function testCanExtractAccountAccessAuthCollection(): void
    {
        $hydrator = new AccountAccessAuthHydrator();
        $accounts = $hydrator->hydrateCollection([AccountAccessAuth::VALID_DATA]);
        $accounts = $hydrator->extractCollection($accounts);

        $this->assertIsArray($accounts);
        $this->assertArrayHasKey(0, $accounts);
        $this->assertSame(AccountAccessAuth::VALID_DATA, $accounts[0]);
    }
}
