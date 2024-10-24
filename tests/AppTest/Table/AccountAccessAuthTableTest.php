<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Table;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Entity\AccountAccessAuthCollection;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydrator;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydratorInterface;
use Stormannsgal\App\Table\AccountAccessAuthTable;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Store\AccountAccessAuthStoreInterface;
use Stormannsgal\Mock\Constants\AccountAccessAuth;
use Stormannsgal\Mock\Database\MockQuery;
use Stormannsgal\Mock\Database\MockQueryFailed;

class AccountAccessAuthTableTest extends TestCase
{
    private AccountAccessAuthHydratorInterface $hydrator;
    private MockQuery $query;
    private AccountAccessAuthStoreInterface $table;

    protected function setUp(): void
    {
        $this->query = new MockQuery();
        $this->hydrator = new AccountAccessAuthHydrator();
        $this->table = new AccountAccessAuthTable($this->query, $this->hydrator);
    }

    public function testCanGetTableName(): void
    {
        $this->assertSame('AccountAccessAuth', $this->table->getTableName());
    }

    public function testCanInsertAccountAccessAuth(): void
    {
        $accountAccessAuth = $this->hydrator->hydrate(AccountAccessAuth::VALID_DATA);

        $result = $this->table->insert($accountAccessAuth);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testInsertAccountAccessAuthThrowsException(): void
    {
        $accountAccessAuth = $this->hydrator->hydrate(AccountAccessAuth::VALID_DATA);
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $this->expectException(DuplicateEntryException::class);

        $table->insert($accountAccessAuth);
    }

    public function testCanUpdateAccountAccessAuth(): void
    {
        $accountAccessAuth = $this->hydrator->hydrate(AccountAccessAuth::VALID_DATA);

        $result = $this->table->update($accountAccessAuth);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testUpdateAccountAccessAuthThrowsException(): void
    {
        $accountAccessAuth = $this->hydrator->hydrate(AccountAccessAuth::VALID_DATA);
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $this->expectException(InvalidArgumentException::class);

        $table->update($accountAccessAuth);
    }

    public function testCanDeleteById(): void
    {
        $result = $this->table->deleteById(AccountAccessAuth::ID);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testDeleteAccountThrowsException(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $this->expectException(InvalidArgumentException::class);

        $table->deleteById(AccountAccessAuth::ID);
    }

    public function testCanFindById(): void
    {
        $result = $this->table->findById(AccountAccessAuth::ID);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result);
        $this->assertSame(AccountAccessAuth::ID, $result->getId());
    }

    public function testFindByIdIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findById(AccountAccessAuth::ID);

        $this->assertNull($result);
    }

    public function testCanFindByUserId(): void
    {
        $result = $this->table->findByUserId(AccountAccessAuth::USER_ID);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertSame(AccountAccessAuth::USER_ID, $result[0]->getUserId());
    }

    public function testFindByUserIdIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findByUserId(AccountAccessAuth::USER_ID);

        $this->assertInstanceOf(AccountAccessAuthCollection::class, $result);
        $this->assertEmpty($result);
    }

    public function testCanFindByLabel(): void
    {
        $result = $this->table->findByLabel(AccountAccessAuth::LABEL);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertSame(AccountAccessAuth::LABEL, $result[0]->getLabel());
    }

    public function testFindByLabelIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findByLabel(AccountAccessAuth::LABEL);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertEmpty($result);
    }

    public function testCanFindByRefreshToken(): void
    {
        $result = $this->table->findByRefreshToken(AccountAccessAuth::REFRESH_TOKEN);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result);
        $this->assertSame(AccountAccessAuth::REFRESH_TOKEN, $result->getRefreshToken());
    }

    public function testFindByRefreshTokenIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findByRefreshToken(AccountAccessAuth::REFRESH_TOKEN);

        $this->assertNull($result);
    }

    public function testCanFindByUserAgent(): void
    {
        $result = $this->table->findByUserAgent(AccountAccessAuth::USER_AGENT);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertSame(AccountAccessAuth::USER_AGENT, $result[0]->getUserAgent());
    }

    public function testFindByUserAgentIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findByUserAgent(AccountAccessAuth::USER_AGENT);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertEmpty($result);
    }

    public function testCanFindByClientIdentHash(): void
    {
        $result = $this->table->findByClientIdentHash(AccountAccessAuth::CLIENT_IDENT_HASH);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result);
        $this->assertSame(AccountAccessAuth::CLIENT_IDENT_HASH, $result->getClientIdentHash());
    }

    public function testFindByClientIdentHashIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findByClientIdentHash(AccountAccessAuth::CLIENT_IDENT_HASH);

        $this->assertNull($result);
    }

    public function testCanFindAll(): void
    {
        $result = $this->table->findAll();

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertSame(AccountAccessAuth::ID, $result[0]->getId());
    }

    public function testFindAllIsEmpty(): void
    {
        $table = new AccountAccessAuthTable(new MockQueryFailed(), $this->hydrator);

        $result = $table->findAll();

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertEmpty($result);
    }
}
