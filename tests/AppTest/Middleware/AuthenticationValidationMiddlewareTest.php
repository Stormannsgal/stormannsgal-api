<?php declare(strict_types=1);

namespace Stormannsgal\AppTest\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Stormannsgal\App\Middleware\AuthenticationValidationMiddleware;
use Stormannsgal\Mock\Validator\MockAuthenticationValidator;
use Stormannsgal\Mock\Validator\MockAuthenticationValidatorFailed;

class AuthenticationValidationMiddlewareTest extends AbstractTestMiddleware
{
    public function testValidationIsValid(): void
    {
        $middleware = new AuthenticationValidationMiddleware(new MockAuthenticationValidator());

        $response = $middleware->process($this->request, $this->handler);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertNotInstanceOf(JsonResponse::class, $response);
    }

    public function testValidationFailed(): void
    {
        $middleware = new AuthenticationValidationMiddleware(new MockAuthenticationValidatorFailed());

        $response = $middleware->process($this->request, $this->handler);

        $json = $this->getContentAsJson($response);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
        $this->assertJsonValueEquals($json, '$.statusCode', '400');
        $this->assertJsonValueEquals($json, '$.message', 'Invalid Data');
    }
}
