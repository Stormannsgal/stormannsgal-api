<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerInterface;
use Stormannsgal\App\Service\RefreshTokenService;

readonly class RefreshTokenValidationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): RefreshTokenValidationMiddleware
    {
        return new RefreshTokenValidationMiddleware(
            $container->get(RefreshTokenService::class)
        );
    }
}
