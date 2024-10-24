<?php declare(strict_types=1);

namespace Stormannsgal\App\Table;

use Envms\FluentPDO\Query;
use InvalidArgumentException;
use PDOException;
use Ramsey\Uuid\UuidInterface;
use Stormannsgal\App\Hydrator\AccountHydratorInterface;
use Stormannsgal\Core\Entity\AccountCollectionInterface;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Store\AccountStoreInterface;
use Stormannsgal\Core\Type\Email;

use function is_array;
use function sprintf;

class AccountTable extends AbstractTable implements AccountStoreInterface
{
    public function __construct(
        Query $query,
        protected AccountHydratorInterface $hydrator
    ) {
        parent::__construct($query);
    }

    public function insert(AccountInterface $data): true
    {
        $value = $this->hydrator->extract($data);

        try {
            $this->query->insertInto($this->table, $value)->execute();
        } catch (PDOException $e) {
            return throw new DuplicateEntryException('Account', $data->getId());
        }

        return true;
    }

    public function update(AccountInterface $data): true
    {
        $value = $this->hydrator->extract($data);

        $result = $this->query->update($this->table, $value, $data->getId())->execute();

        if ($result === false) {
            throw new InvalidArgumentException(
                sprintf('Unknown Error while updating account with id: %s', $data->getId())
            );
        }

        return true;
    }

    public function findById(int $id): ?AccountInterface
    {
        $result = $this->query->from($this->table)
            ->where('id', $id)
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findByUuid(UuidInterface $uuid): ?AccountInterface
    {
        $result = $this->query->from($this->table)
            ->where('uuid', $uuid->getHex()->toString())
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findByName(string $name): ?AccountInterface
    {
        $result = $this->query->from($this->table)
            ->where('name', $name)
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findByEmail(Email $email): ?AccountInterface
    {
        $result = $this->query->from($this->table)
            ->where('email', $email->toString())
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findAll(): AccountCollectionInterface
    {
        $result = $this->query->from($this->table)->fetchAll();

        return is_array($result) ? $this->hydrator->hydrateCollection($result) : $this->hydrator->hydrateCollection([]);
    }
}
