<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\RefreshToken;
use Stormannsgal\App\Service\RefreshTokenService;

readonly class RefreshTokenValidationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private RefreshTokenService $tokenService,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $refreshToken = $request->getHeaderLine('Authentication');

        if (!$this->tokenService->isValid($refreshToken)) {
            return new JsonResponse(['error' => 'invalid Access'], HTTP::STATUS_UNAUTHORIZED);
        }

        $refreshToken = RefreshToken::fromString($refreshToken);

        return $handler->handle($request->withAttribute(RefreshToken::class, $refreshToken));
    }
}
