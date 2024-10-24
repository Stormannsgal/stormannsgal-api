<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerInterface;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;

readonly class AccountAccessAuthPersistMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AccountAccessAuthPersistMiddleware
    {
        return new AccountAccessAuthPersistMiddleware(
            $container->get(AccountAccessAuthRepositoryInterface::class)
        );
    }
}
