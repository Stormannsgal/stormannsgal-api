<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Middleware;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Middleware\AuthenticationMiddleware;
use Stormannsgal\App\Middleware\AuthenticationMiddlewareFactory;
use Stormannsgal\App\Repository\AccountRepository;
use Stormannsgal\App\Service\AuthenticationService;
use Stormannsgal\Mock\MockContainer;
use Stormannsgal\Mock\Repository\MockAccountRepository;
use Stormannsgal\Mock\Service\MockAuthenticationService;

class AuthenticationMiddlewareFactoryTest extends TestCase
{
    public function testCanCreateAuthenticationMiddlewareInstance(): void
    {
        $container = new MockContainer(
            [
                AuthenticationService::class => new MockAuthenticationService(),
                AccountRepository::class => new MockAccountRepository(),
            ]
        );

        $middleware = (new AuthenticationMiddlewareFactory())($container);

        $this->assertInstanceOf(AuthenticationMiddleware::class, $middleware);
    }
}
