<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerInterface;
use Stormannsgal\App\Service\ClientIdentificationService;

readonly class ClientIdentificationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ClientIdentificationMiddleware
    {
        $clientIdentificationService = $container->get(ClientIdentificationService::class);

        return new ClientIdentificationMiddleware($clientIdentificationService);
    }
}
