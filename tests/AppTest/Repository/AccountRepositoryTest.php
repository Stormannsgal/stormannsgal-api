<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Repository;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Stormannsgal\App\Hydrator\AccountHydrator;
use Stormannsgal\App\Hydrator\AccountHydratorInterface;
use Stormannsgal\App\Repository\AccountRepository;
use Stormannsgal\Core\Entity\AccountCollectionInterface;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Exception\EmptyResultException;
use Stormannsgal\Core\Repository\AccountRepositoryInterface;
use Stormannsgal\Core\Type\Email;
use Stormannsgal\Mock\Constants\Account;
use Stormannsgal\Mock\Table\MockAccountTable;
use Stormannsgal\Mock\Table\MockAccountTableFailed;

class AccountRepositoryTest extends TestCase
{
    private AccountRepositoryInterface $repository;
    private AccountHydratorInterface $hydrator;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new AccountRepository(new MockAccountTable());
        $this->hydrator = new AccountHydrator();
    }

    public function testCanInsertAccount(): void
    {
        $result = $this->repository->insert($this->hydrator->hydrate(Account::VALID_DATA));

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testInsertAccountThrowsException(): void
    {
        $this->expectException(DuplicateEntryException::class);

        $this->repository->insert($this->hydrator->hydrate(Account::INVALID_DATA));
    }

    public function testCanUpdateAccount(): void
    {
        $result = $this->repository->update($this->hydrator->hydrate(Account::VALID_DATA));

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testUpdateAccountThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repository->update($this->hydrator->hydrate(Account::INVALID_DATA));
    }

    public function testCanDeleteAccountById(): void
    {
        $result = $this->repository->deleteById(Account::ID);

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    public function testDeleteAccountByIdThrowsInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->repository->deleteById(Account::ID_INVALID);
    }

    public function testCanFindById(): void
    {
        $result = $this->repository->findById(Account::ID);

        $this->assertInstanceOf(AccountInterface::class, $result);
        $this->assertSame(Account::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByIdIsEmpty(): void
    {
        $result = $this->repository->findById(Account::ID_INVALID);

        $this->assertNull($result);
    }

    public function testCanFindByUuid(): void
    {
        $uuid = Uuid::fromString(Account::UUID);
        $result = $this->repository->findByUuid($uuid);

        $this->assertInstanceOf(AccountInterface::class, $result);
        $this->assertSame(Account::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByUuidIsEmtpy(): void
    {
        $uuid = Uuid::fromString(Account::UUID_INVALID);

        $result = $this->repository->findByUuid($uuid);

        $this->assertNull($result);
    }

    public function testCanFindByName(): void
    {
        $result = $this->repository->findByName(Account::NAME);

        $this->assertInstanceOf(AccountInterface::class, $result);
        $this->assertSame(Account::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByNameIsEmpty(): void
    {
        $result = $this->repository->findByName(Account::NAME_INVALID);

        $this->assertNull($result);
    }

    public function testCanFindByEmail(): void
    {
        $result = $this->repository->findByEmail(new Email(Account::EMAIL));

        $this->assertInstanceOf(AccountInterface::class, $result);
        $this->assertSame(Account::VALID_DATA, $this->hydrator->extract($result));
    }

    public function testFindByEmailIsEmpty(): void
    {
        $result = $this->repository->findByEmail(new Email(Account::EMAIL_INVALID));

        $this->assertNull($result);
    }

    public function testCanFindAll(): void
    {
        $result = $this->repository->findAll();

        $this->assertInstanceOf(AccountCollectionInterface::class, $result);
        $this->assertArrayHasKey(0, $result);
        $this->assertInstanceOf(AccountInterface::class, $result[0]);
        $this->assertSame([0 => Account::VALID_DATA], $this->hydrator->extractCollection($result));
    }

    public function testFindAllIsEmpty(): void
    {
        $repository = new AccountRepository(new MockAccountTableFailed());

        $result = $repository->findAll();

        $this->assertInstanceOf(AccountCollectionInterface::class, $result);
        $this->assertEmpty($result);
    }
}
