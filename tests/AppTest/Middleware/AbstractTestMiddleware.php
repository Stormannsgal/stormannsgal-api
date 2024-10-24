<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Middleware;

use Helmich\JsonAssert\JsonAssertions;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\FunctionalTest\JsonRequestHelper;
use Stormannsgal\Mock\MockRequestHandler;
use Stormannsgal\Mock\MockServerRequest;

abstract class AbstractTestMiddleware extends TestCase
{
    use JsonRequestHelper;
    use JsonAssertions;

    protected ServerRequestInterface $request;
    protected RequestHandlerInterface $handler;

    protected function setUp(): void
    {
        $this->request = new MockServerRequest();
        $this->handler = new MockRequestHandler();

        parent::setUp();
    }
}
