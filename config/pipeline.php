<?php

declare(strict_types=1);

use Laminas\Stratigility\Middleware\ErrorHandler;
use Mezzio\Application;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\Helper\ServerUrlMiddleware;
use Mezzio\Helper\UrlHelperMiddleware;
use Mezzio\MiddlewareFactory;
use Mezzio\Router\Middleware\DispatchMiddleware;
use Mezzio\Router\Middleware\ImplicitHeadMiddleware;
use Mezzio\Router\Middleware\ImplicitOptionsMiddleware;
use Mezzio\Router\Middleware\MethodNotAllowedMiddleware;
use Mezzio\Router\Middleware\RouteMiddleware;
use Psr\Container\ContainerInterface;
use Stormannsgal\Core\Middleware\RouteNotFoundMiddleware;

/**
 * Setup middleware pipeline:
 */

return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->pipe('/api', [
        ErrorHandler::class,
        ServerUrlMiddleware::class,

        RouteMiddleware::class,

        ImplicitHeadMiddleware::class,
        ImplicitOptionsMiddleware::class,
        MethodNotAllowedMiddleware::class,

        UrlHelperMiddleware::class,

        DispatchMiddleware::class,

        RouteNotFoundMiddleware::class,
        NotFoundHandler::class,
    ]);
};
