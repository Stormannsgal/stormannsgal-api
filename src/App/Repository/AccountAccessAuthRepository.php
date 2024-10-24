<?php declare(strict_types=1);

namespace Stormannsgal\App\Repository;

use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Core\Store\AccountAccessAuthStoreInterface;

readonly class AccountAccessAuthRepository implements AccountAccessAuthRepositoryInterface
{
    public function __construct(
        private AccountAccessAuthStoreInterface $store,
    ) {
    }

    public function insert(AccountAccessAuthInterface $accountAccessAuth): true
    {
        return $this->store->insert($accountAccessAuth);
    }

    public function update(AccountAccessAuthInterface $accountAccessAuth): true
    {
        return $this->store->update($accountAccessAuth);
    }

    public function deleteById(int $id): true
    {
        return $this->store->deleteById($id);
    }

    public function findById(int $id): ?AccountAccessAuthInterface
    {
        return $this->store->findById($id);
    }

    public function findByUserId(int $userId): AccountAccessAuthCollectionInterface
    {
        return $this->store->findByUserId($userId);
    }

    public function findByLabel(string $label): AccountAccessAuthCollectionInterface
    {
        return $this->store->findByLabel($label);
    }

    public function findByRefreshToken(string $refreshToken): ?AccountAccessAuthInterface
    {
        return $this->store->findByRefreshToken($refreshToken);
    }

    public function findByUserAgent(string $userAgent): AccountAccessAuthCollectionInterface
    {
        return $this->store->findByUserAgent($userAgent);
    }

    public function findByClientIdentHash(string $clientIdentHash): ?AccountAccessAuthInterface
    {
        return $this->store->findByClientIdentHash($clientIdentHash);
    }

    public function findAll(): AccountAccessAuthCollectionInterface
    {
        return $this->store->findAll();
    }
}
