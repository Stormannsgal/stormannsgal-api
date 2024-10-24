<?php declare(strict_types=1);

namespace Stormannsgal\App\Handler;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use OpenApi\Attributes as OA;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

#[OA\Info(
    version: '0.1.0',
    title: 'Stormannsgal API Overview',
)]
#[OA\SecurityScheme(
    securityScheme: 'accessToken',
    type: 'apiKey',
    name: 'Authorization',
    in: 'header',
)
]
#[OA\SecurityScheme(
    securityScheme: 'refreshToken',
    type: 'apiKey',
    name: 'Authentication',
    in: 'header',
)
]
#[OA\SecurityScheme(
    securityScheme: 'Client Identification Number',
    type: 'apiKey',
    name: 'x-ident',
    in: 'header',
)]
#[OA\OpenApi(
    servers: [
        new OA\Server(
            url: '/api'
        ),
    ],
    security: [['accessToken' => []], ['Client Identification Number' => []], ['refreshToken' => []]]
)]
readonly class SwaggerUIHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $indexFile = ROOT_DIR . 'public/docs/index.html';

        if (file_exists($indexFile)) {
            return new HtmlResponse(file_get_contents($indexFile));
        }

        return new JsonResponse([], HTTP::STATUS_NO_CONTENT);
    }
}
