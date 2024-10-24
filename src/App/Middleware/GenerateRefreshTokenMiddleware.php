<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\ClientIdentification;
use Stormannsgal\App\DTO\RefreshToken;
use Stormannsgal\App\Service\RefreshTokenService;

readonly class GenerateRefreshTokenMiddleware implements MiddlewareInterface
{
    public function __construct(
        private RefreshTokenService $tokenService,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $clientIdentification = $request->getAttribute(ClientIdentification::class);

        $refreshToken = $this->tokenService->generate($clientIdentification);

        $refreshToken = RefreshToken::fromString($refreshToken);

        return $handler->handle($request->withAttribute(RefreshToken::class, $refreshToken));
    }
}
