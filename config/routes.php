<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;
use Stormannsgal\App\Handler\Account\AccountCreateHandler;
use Stormannsgal\App\Handler\Account\ListAllAccountsHandler;
use Stormannsgal\App\Handler\PingHandler;
use Stormannsgal\Core\Config\Route;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get(
        path: '/ping',
        middleware: [
            PingHandler::class,
        ],
        name: Route::PING
    );
    $app->post(
        path: '/account',
        middleware: [
            AccountCreateHandler::class,
        ],
        name: Route::ACCOUNT_CREATE
    );
    $app->get(
        path: '/account/list/all',
        middleware: [
            ListAllAccountsHandler::class,
        ],
        name: Route::ACCOUNT_LIST_ALL
    );
};
