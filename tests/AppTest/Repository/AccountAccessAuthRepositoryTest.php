<?php declare(strict_types=1);

namespace AppTest\Repository;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Entity\AccountAccessAuthCollection;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydrator;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydratorInterface;
use Stormannsgal\App\Repository\AccountAccessAuthRepository;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Mock\Constants\AccountAccessAuth;
use Stormannsgal\Mock\Table\MockAccountAccessAuthTable;
use Stormannsgal\Mock\Table\MockAccountAccessAuthTableFailed;

class AccountAccessAuthRepositoryTest extends TestCase
{
    private AccountAccessAuthRepositoryInterface $repository;
    private AccountAccessAuthHydratorInterface $hydrator;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new AccountAccessAuthRepository(new MockAccountAccessAuthTable());
        $this->hydrator = new AccountAccessAuthHydrator();
    }

    public function testCanInsertAccountAccessAuth(): void
    {
        $result = $this->repository->insert($this->hydrator->hydrate(AccountAccessAuth::VALID_DATA));

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testInsertAccountAccessAuthThrowDuplicateEntryException(): void
    {
        $this->expectException(DuplicateEntryException::class);

        $this->repository->insert($this->hydrator->hydrate(AccountAccessAuth::INVALID_DATA));
    }

    public function testCanUpdateAccountAccessAuth(): void
    {
        $result = $this->repository->update($this->hydrator->hydrate(AccountAccessAuth::VALID_DATA));

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testUpdateAccountAccessAuthThrowInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repository->update($this->hydrator->hydrate(AccountAccessAuth::INVALID_DATA));
    }

    public function testCanDeleteById(): void
    {
        $result = $this->repository->deleteById(AccountAccessAuth::ID);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testDeleteByIdThrowInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repository->deleteById(AccountAccessAuth::ID_INVALID);
    }

    public function testCanFindById(): void
    {
        $result = $this->repository->findById(AccountAccessAuth::ID);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result);
        $this->assertSame(AccountAccessAuth::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByIdIsEmpty(): void
    {
        $result = $this->repository->findById(AccountAccessAuth::ID_INVALID);

        $this->assertNull($result);
    }

    public function testCanFindByUserId(): void
    {
        $result = $this->repository->findByUserId(AccountAccessAuth::USER_ID);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result[0]);
        $this->assertSame([0 => AccountAccessAuth::VALID_DATA], $this->hydrator->extractCollection($result));
    }

    public function testFindByUserIdIsEmpty(): void
    {
        $result = $this->repository->findByUserId(AccountAccessAuth::USER_ID_INVALID);

        $this->assertInstanceOf(AccountAccessAuthCollection::class, $result);
        $this->assertEmpty($result);
    }

    public function testCanFindByLabel(): void
    {
        $result = $this->repository->findByLabel(AccountAccessAuth::LABEL);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result[0]);
        $this->assertSame([0 => AccountAccessAuth::VALID_DATA], $this->hydrator->extractCollection($result));
    }

    public function testFindByLabelIsEmpty(): void
    {
        $result = $this->repository->findByLabel(AccountAccessAuth::LABEL_INVALID);

        $this->assertInstanceOf(AccountAccessAuthCollection::class, $result);
        $this->assertEmpty($result);
    }

    public function testCanFindByRefreshToken(): void
    {
        $result = $this->repository->findByRefreshToken(AccountAccessAuth::REFRESH_TOKEN);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result);
        $this->assertSame(AccountAccessAuth::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByRefreshTokenIsEmpty(): void
    {
        $result = $this->repository->findByRefreshToken(AccountAccessAuth::REFRESH_TOKEN_INVALID);

        $this->assertNull($result);
    }

    public function testCanFindByUserAgent(): void
    {
        $result = $this->repository->findByUserAgent(AccountAccessAuth::USER_AGENT);

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result[0]);
        $this->assertSame([0 => AccountAccessAuth::VALID_DATA], $this->hydrator->extractCollection($result));
    }

    public function testCanFindByUserAgentIsEmpty(): void
    {
        $result = $this->repository->findByUserAgent(AccountAccessAuth::USER_AGENT_INVALID);

        $this->assertInstanceOf(AccountAccessAuthCollection::class, $result);
        $this->assertEmpty($result);
    }

    public function testCanFindByClientIdentHash(): void
    {
        $result = $this->repository->findByClientIdentHash(AccountAccessAuth::CLIENT_IDENT_HASH);

        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result);
        $this->assertSame(AccountAccessAuth::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByClientIdentHashIsEmpty(): void
    {
        $result = $this->repository->findByClientIdentHash(AccountAccessAuth::CLIENT_IDENT_HASH_INVALID);

        $this->assertNull($result);
    }

    public function testCanFindAll(): void
    {
        $result = $this->repository->findAll();

        $this->assertInstanceOf(AccountAccessAuthCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertInstanceOf(AccountAccessAuthInterface::class, $result[0]);
        $this->assertSame([0 => AccountAccessAuth::VALID_DATA], $this->hydrator->extractCollection($result));
    }

    public function testFindAllIsEmpty(): void
    {
        $repository = new AccountAccessAuthRepository(new MockAccountAccessAuthTableFailed());

        $result = $repository->findAll();

        $this->assertInstanceOf(AccountAccessAuthCollection::class, $result);
        $this->assertEmpty($result);
    }
}
