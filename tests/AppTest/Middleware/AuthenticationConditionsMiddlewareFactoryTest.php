<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Middleware;

use PHPUnit\Framework\TestCase;
use Stormannsgal\App\Middleware\AuthenticationConditionsMiddleware;
use Stormannsgal\App\Middleware\AuthenticationConditionsMiddlewareFactory;
use Stormannsgal\Mock\MockContainer;

class AuthenticationConditionsMiddlewareFactoryTest extends TestCase
{
    public function testCanCreateAuthenticationConditionsMiddlewareFactoryTest(): void
    {
        $container = new MockContainer();

        $middleware = (new AuthenticationConditionsMiddlewareFactory())($container);

        $this->assertInstanceOf(AuthenticationConditionsMiddleware::class, $middleware);
    }
}
