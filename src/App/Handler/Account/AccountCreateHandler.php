<?php declare(strict_types=1);

namespace Stormannsgal\App\Handler\Account;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use OpenApi\Attributes as OA;

readonly class AccountCreateHandler implements RequestHandlerInterface
{
    #[OA\Post(
        path: '/account',
        description: 'Create new Account',
        summary: 'Create new Account',
        tags: ['Account'],
        deprecated: true
    )]
    #[OA\Response(response: HTTP::STATUS_OK, description: 'Success')]
    #[OA\Response(response: HTTP::STATUS_UNAUTHORIZED, description: 'Unauthorized')]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([], HTTP::STATUS_OK);
    }
}
