<?php declare(strict_types=1);

namespace Stormannsgal\App\Table;

use Envms\FluentPDO\Exception;
use Envms\FluentPDO\Query;
use InvalidArgumentException;
use PDOException;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydratorInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Store\AccountAccessAuthStoreInterface;

use function is_array;

class AccountAccessAuthTable extends AbstractTable implements AccountAccessAuthStoreInterface
{
    public function __construct(
        Query $query,
        protected AccountAccessAuthHydratorInterface $hydrator
    ) {
        parent::__construct($query);
    }

    public function insert(AccountAccessAuthInterface $data): true
    {
        $value = $this->hydrator->extract($data);

        unset($value['id']);

        try {
            $lastInsertId = $this->query->insertInto($this->table, $value)->execute();
        } catch (Exception | PDOException $e) {
            return throw new DuplicateEntryException('AccountAccessAuth', $data->getId());
        }

        return true;
    }

    public function update(AccountAccessAuthInterface $data): true
    {
        $value = $this->hydrator->extract($data);

        $affectedRowCount = $this->query->update($this->table, $value, $value['id'])->execute();

        if (!$affectedRowCount) {
            throw new InvalidArgumentException('Account Access Auth data could not be modified');
        }

        return true;
    }

    public function findById(int $id): ?AccountAccessAuthInterface
    {
        $result = $this->query->from($this->table)
            ->where('id', $id)
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findByUserId(int $userId): AccountAccessAuthCollectionInterface
    {
        $result = $this->query->from($this->table)
            ->where('userId', $userId)
            ->fetch();

        return is_array($result)
            ? $this->hydrator->hydrateCollection($result)
            : $this->hydrator->hydrateCollection(
                []
            );
    }

    public function findByLabel(string $label): AccountAccessAuthCollectionInterface
    {
        $result = $this->query->from($this->table)
            ->where('label', $label)
            ->fetch();

        return is_array($result)
            ? $this->hydrator->hydrateCollection($result)
            : $this->hydrator->hydrateCollection(
                []
            );
    }

    public function findByRefreshToken(string $refreshToken): ?AccountAccessAuthInterface
    {
        $result = $this->query->from($this->table)
            ->where('refreshToken', $refreshToken)
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findByUserAgent(string $userAgent): AccountAccessAuthCollectionInterface
    {
        $result = $this->query->from($this->table)
            ->where('userAgent', $userAgent)
            ->fetch();

        return is_array($result)
            ? $this->hydrator->hydrateCollection($result)
            : $this->hydrator->hydrateCollection(
                []
            );
    }

    public function findByClientIdentHash(string $clientIdentHash): ?AccountAccessAuthInterface
    {
        $result = $this->query->from($this->table)
            ->where('clientIdentHash', $clientIdentHash)
            ->fetch();

        return is_array($result) ? $this->hydrator->hydrate($result) : null;
    }

    public function findAll(): AccountAccessAuthCollectionInterface
    {
        $result = $this->query->from($this->table)->fetchAll();

        return is_array($result)
            ? $this->hydrator->hydrateCollection($result)
            : $this->hydrator->hydrateCollection(
                []
            );
    }
}
