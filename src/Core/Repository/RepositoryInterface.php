<?php declare(strict_types=1);

namespace Stormannsgal\Core\Repository;

interface RepositoryInterface
{
    public function deleteById(int $id): true;
}
