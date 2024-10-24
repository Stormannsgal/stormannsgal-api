<?php declare(strict_types=1);

namespace Stormannsgal\App\Repository;

use Psr\Container\ContainerInterface;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Core\Store\AccountAccessAuthStoreInterface;

readonly class AccountAccessAuthRepositoryFactory
{
    public function __invoke(ContainerInterface $container): AccountAccessAuthRepositoryInterface
    {
        return new AccountAccessAuthRepository(
            $container->get(AccountAccessAuthStoreInterface::class)
        );
    }
}
