<?php

declare(strict_types=1);

use Laminas\Stratigility\Middleware\ErrorHandler;
use Stormannsgal\Core\Listener\LoggingErrorListenerDelegatorFactory;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            PDO::class => 'database',
            Envms\FluentPDO\Query::class => 'query',
            Psr\Log\LoggerInterface::class => 'logger',
        ],
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            'database' => \Stormannsgal\Core\Factory\DatabaseFactory::class,
            'query' => \Stormannsgal\Core\Factory\QueryFactory::class,
            'logger' => \Stormannsgal\Core\Logger\LoggerFactory::class,
        ],
        'delegators' => [
            ErrorHandler::class => [
                LoggingErrorListenerDelegatorFactory::class,
            ],
        ],
    ],
];
