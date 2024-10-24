<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\AuthenticationFailureMessage;

readonly class AuthenticationConditionsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->hasHeader('Authentication') || $request->hasHeader('Authorization')) {
            $message = AuthenticationFailureMessage::create(
                HTTP::STATUS_FORBIDDEN,
                'There is currently successful authentication'
            );

            return new JsonResponse($message, HTTP::STATUS_FORBIDDEN);
        }

        return $handler->handle($request);
    }
}
