<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stormannsgal\App\Service\RefreshTokenService;

readonly class GenerateRefreshTokenMiddlewareFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): GenerateRefreshTokenMiddleware
    {
        $refreshTokenService = $container->get(RefreshTokenService::class);

        return new GenerateRefreshTokenMiddleware($refreshTokenService);
    }
}
