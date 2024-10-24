<?php declare(strict_types=1);

namespace Stormannsgal\Core\Validator;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stormannsgal\Core\Validator\Input\EmailInput;
use Stormannsgal\Core\Validator\Input\PasswordInput;

class AuthenticationValidatorFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AuthenticationValidator
    {
        $emailInput = $container->get(EmailInput::class);
        $passwordInput = $container->get(PasswordInput::class);

        return new AuthenticationValidator($emailInput, $passwordInput);
    }
}
