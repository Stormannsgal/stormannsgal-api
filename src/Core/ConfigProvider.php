<?php declare(strict_types=1);

namespace Stormannsgal\Core;

use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Psr\Log\LoggerInterface;
use Stormannsgal\Core\Listener\LoggingErrorListener;
use Stormannsgal\Core\Listener\LoggingErrorListenerFactory;
use Stormannsgal\Core\Validator\Input\EmailInput;
use Stormannsgal\Core\Validator\Input\PasswordInput;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            ConfigAbstractFactory::class => $this->getAbstractFactoryConfig(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                EmailInput::class => EmailInput::class,
                PasswordInput::class => PasswordInput::class,
            ],
            'aliases' => [
            ],
            'factories' => [
                LoggingErrorListener::class => LoggingErrorListenerFactory::class,
                Middleware\RouteNotFoundMiddleware::class => ConfigAbstractFactory::class,

                Validator\AuthenticationValidator::class => Validator\AuthenticationValidatorFactory::class,
            ],
        ];
    }

    public function getAbstractFactoryConfig(): array
    {
        return [
            Middleware\RouteNotFoundMiddleware::class => [
                LoggerInterface::class,
            ],
        ];
    }
}
