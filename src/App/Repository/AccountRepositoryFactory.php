<?php declare(strict_types=1);

namespace Stormannsgal\App\Repository;

use Psr\Container\ContainerInterface;
use Stormannsgal\Core\Repository\AccountRepositoryInterface;
use Stormannsgal\Core\Store\AccountStoreInterface;

readonly class AccountRepositoryFactory
{
    public function __invoke(ContainerInterface $container): AccountRepositoryInterface
    {
        return new AccountRepository(
            $container->get(AccountStoreInterface::class),
        );
    }
}
