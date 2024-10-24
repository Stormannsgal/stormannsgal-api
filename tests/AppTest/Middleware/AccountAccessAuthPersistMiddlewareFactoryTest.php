<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Middleware;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Middleware\AccountAccessAuthPersistMiddleware;
use Stormannsgal\App\Middleware\AccountAccessAuthPersistMiddlewareFactory;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Mock\MockContainer;
use Stormannsgal\Mock\Repository\MockAccountAccessAuthRepository;

class AccountAccessAuthPersistMiddlewareFactoryTest extends TestCase
{
    public function testCanCreateAccountAccessAuthPersistMiddlewareInstance(): void
    {
        $container = new MockContainer(
            [
                AccountAccessAuthRepositoryInterface::class => new MockAccountAccessAuthRepository(),
            ]
        );

        $middleware = (new AccountAccessAuthPersistMiddlewareFactory())($container);

        $this->assertInstanceOf(AccountAccessAuthPersistMiddleware::class, $middleware);
    }
}
