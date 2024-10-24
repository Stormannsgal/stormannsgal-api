<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Container\ContainerInterface;
use Stormannsgal\Core\Validator\AuthenticationValidator;

readonly class AuthenticationValidationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationValidationMiddleware
    {
        $authenticationValidator = $container->get(AuthenticationValidator::class);

        return new AuthenticationValidationMiddleware($authenticationValidator);
    }
}
