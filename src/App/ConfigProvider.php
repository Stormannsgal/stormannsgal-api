<?php declare(strict_types=1);

namespace Stormannsgal\App;

use Stormannsgal\App\Handler\PingHandler;
use Stormannsgal\App\Repository\AccountAccessAuthRepositoryFactory;
use Stormannsgal\App\Repository\AccountRepositoryFactory;
use Stormannsgal\App\Table\AccountAccessAuthTable;
use Stormannsgal\App\Table\AccountAccessAuthTableFactory;
use Stormannsgal\App\Table\AccountTable;
use Stormannsgal\App\Table\AccountTableFactory;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Core\Repository\AccountRepositoryInterface;
use Stormannsgal\Core\Store;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'alias' => [

            ],
            'invokables' => [
                Handler\Account\AccessTokenHandler::class => Handler\Account\AccessTokenHandler::class,
                Handler\Account\AuthenticationHandler::class => Handler\Account\AuthenticationHandler::class,
                Handler\Account\ListAllAccountsHandler::class => Handler\Account\ListAllAccountsHandler::class,
                Handler\PingHandler::class => PingHandler::class,

                Hydrator\AccountHydrator::class => Hydrator\AccountHydrator::class,
                Hydrator\AccountAccessAuthHydrator::class => Hydrator\AccountAccessAuthHydrator::class,

                Hydrator\AccountHydratorInterface::class => Hydrator\AccountHydrator::class,
                Hydrator\AccountAccessAuthHydratorInterface::class => Hydrator\AccountAccessAuthHydrator::class,

                AccountAccessAuthRepositoryInterface::class => Repository\AccountAccessAuthRepository::class,
                AccountRepositoryInterface::class => Repository\AccountRepository::class,
                Service\AuthenticationService::class => Service\AuthenticationService::class,
                Service\ClientIdentificationService::class => Service\ClientIdentificationService::class,
                Service\RefreshTokenService::class => Service\RefreshTokenService::class,

                Store\AccountStoreInterface::class => AccountTable::class,
                Store\AccountAccessAuthStoreInterface::class => AccountAccessAuthTable::class,
            ],
            'factories' => [
                Middleware\AccountAccessAuthPersistMiddleware::class => Middleware\AccountAccessAuthPersistMiddlewareFactory::class,
                Middleware\AuthenticationConditionsMiddleware::class => Middleware\AuthenticationConditionsMiddlewareFactory::class,
                Middleware\AuthenticationMiddleware::class => Middleware\AuthenticationMiddlewareFactory::class,
                Middleware\AuthenticationValidationMiddleware::class => Middleware\AuthenticationValidationMiddlewareFactory::class,
                Middleware\ClientIdentificationMiddleware::class => Middleware\ClientIdentificationMiddlewareFactory::class,
                Middleware\GenerateRefreshTokenMiddleware::class => Middleware\GenerateRefreshTokenMiddlewareFactory::class,

                Repository\AccountRepository::class => AccountRepositoryFactory::class,
                Repository\AccountAccessAuthRepository::class => AccountAccessAuthRepositoryFactory::class,

                Service\RefreshTokenService::class => Service\RefreshTokenServiceFactory::class,

                Table\AccountTable::class => AccountTableFactory::class,
                Table\AccountAccessAuthTable::class => AccountAccessAuthTableFactory::class,
            ],
        ];
    }
}
