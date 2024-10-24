<?php declare(strict_types=1);

namespace Stormannsgal\Core\Repository;

use Ramsey\Uuid\UuidInterface;
use Stormannsgal\Core\Entity\AccountCollectionInterface;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Type\Email;

interface AccountRepositoryInterface extends RepositoryInterface
{
    public function insert(AccountInterface $data): true;

    public function update(AccountInterface $data): true;

    public function findById(int $id): ?AccountInterface;

    public function findByUuid(UuidInterface $uuid): ?AccountInterface;

    public function findByName(string $name): ?AccountInterface;

    public function findByEmail(Email $email): ?AccountInterface;

    public function findAll(): AccountCollectionInterface;
}
