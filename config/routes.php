<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Stormannsgal\App;
use Stormannsgal\Core\Config\Route;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get(
        path: '/ping[/]',
        middleware: [
            App\Handler\PingHandler::class,
        ],
        name: Route::PING
    );
    $app->get(
        path: '/token/refresh[/]',
        middleware: [
            App\Handler\Account\AccessTokenHandler::class
        ],
        name: Route::REFRESH_ACCESS_TOKEN
    );
    $app->post(
        path: '/account/authentication[/]',
        middleware: [
            App\Middleware\AuthenticationConditionsMiddleware::class,
            App\Middleware\AuthenticationValidationMiddleware::class,
            App\Middleware\AuthenticationMiddleware::class,
            App\Middleware\GenerateRefreshTokenMiddleware::class,
            App\Middleware\AccountAccessAuthPersistMiddleware::class,
            App\Handler\Account\AuthenticationHandler::class,
        ],
        name: Route::AUTHENTICATE_ACCOUNT
    );

    $app->post(
        path: '/account',
        middleware: [
            App\Handler\Account\AccountCreateHandler::class,
        ],
        name: Route::CREATE_ACCOUNT
    );

    $app->get(
        path: '/account/list/all',
        middleware: [
            App\Handler\Account\ListAllAccountsHandler::class,
        ],
        name: Route::LIST_ALL_ACCOUNT
    );
};
