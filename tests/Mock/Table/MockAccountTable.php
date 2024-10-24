<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Table;

use InvalidArgumentException;
use Ramsey\Uuid\UuidInterface;
use Stormannsgal\App\Entity\AccountCollection;
use Stormannsgal\App\Hydrator\AccountHydrator;
use Stormannsgal\App\Table\AccountTable;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Store\AccountStoreInterface;
use Stormannsgal\Core\Type\Email;
use Stormannsgal\Mock\Constants\Account;
use Stormannsgal\Mock\Database\MockQuery;

class MockAccountTable extends AccountTable implements AccountStoreInterface
{
    public function __construct()
    {
        parent::__construct(
            new MockQuery(),
            new AccountHydrator(),
        );
    }

    public function getTableName(): string
    {
        return 'Account';
    }

    public function insert(AccountInterface $data): true
    {
        if ($data->getId() !== Account::ID) {
            throw new DuplicateEntryException('Account', $data->getId());
        }

        return true;
    }

    public function update(AccountInterface $data): true
    {
        if ($data->getId() !== Account::ID) {
            throw new InvalidArgumentException();
        }

        return true;
    }

    public function deleteById(int $id): true
    {
        if ($id !== Account::ID) {
            throw new InvalidArgumentException();
        }

        return true;
    }

    public function findById(int $id): ?AccountInterface
    {
        return $id === Account::ID ? $this->hydrator->hydrate(Account::VALID_DATA) : null;
    }

    public function findByUuid(UuidInterface $uuid): ?AccountInterface
    {
        return $uuid->getHex()->toString() === Account::UUID ? $this->hydrator->hydrate(Account::VALID_DATA) : null;
    }

    public function findByName(string $name): ?AccountInterface
    {
        return $name === Account::NAME ? $this->hydrator->hydrate(Account::VALID_DATA) : null;
    }

    public function findByEmail(Email $email): ?AccountInterface
    {
        return $email->toString() === Account::EMAIL ? $this->hydrator->hydrate(Account::VALID_DATA) : null;
    }

    public function findAll(): AccountCollection
    {
        return $this->hydrator->hydrateCollection([Account::VALID_DATA]);
    }
}
