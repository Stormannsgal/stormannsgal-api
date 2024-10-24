<?php declare(strict_types=1);

namespace Stormannsgal\App\Handler\Account;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly class ListAllAccountsHandler implements RequestHandlerInterface
{
    #[OA\Get(
        path: '/account/list/all',
        description: 'All accounts are listed in the list. Whether active, inactive, banned or deleted',
        summary: 'Listing of all accounts',
        tags: ['Account'],
        deprecated: true
    )]
    #[OA\Response(response: HTTP::STATUS_OK, description: 'Success')]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new JsonResponse([], HTTP::STATUS_OK);
    }
}
