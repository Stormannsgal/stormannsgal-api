<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerInterface;
use Stormannsgal\App\Repository\AccountRepository;
use Stormannsgal\App\Service\AuthenticationService;

readonly class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationMiddleware
    {
        $service = $container->get(AuthenticationService::class);
        $repository = $container->get(AccountRepository::class);

        return new AuthenticationMiddleware($service, $repository);
    }
}
