<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerInterface;

readonly class AuthenticationConditionsMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationConditionsMiddleware
    {
        return new AuthenticationConditionsMiddleware();
    }
}
