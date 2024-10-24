<?php declare(strict_types=1);

namespace Stormannsgal\App\Handler\Account;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\AccessToken;

readonly class AccessTokenHandler implements RequestHandlerInterface
{
    /**
     * If authenticated, a new access token is transmitted
     */
    #[OA\Get(path: '/token/refresh', tags: ['Account'])]
    #[OA\Response(
        response: HTTP::STATUS_OK,
        description: 'Success',
        content: [new OA\JsonContent(ref: AccessToken::class)]
    )]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $accessToken = $request->getAttribute(AccessToken::class);

        return new JsonResponse($accessToken, HTTP::STATUS_OK);
    }
}
