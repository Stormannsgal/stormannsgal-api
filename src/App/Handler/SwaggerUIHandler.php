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
    securityScheme: 'bearerAuth',
    type: 'http',
    name: 'Authorization',
    in: 'header',
    bearerFormat: 'JWT',
    scheme: 'bearer',
)
]
#[OA\OpenApi(
    servers: [
        new OA\Server(
            url: '/api'
        ),
    ],
    security: [['bearerAuth' => []]]
)]
class SwaggerUIHandler implements RequestHandlerInterface
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
