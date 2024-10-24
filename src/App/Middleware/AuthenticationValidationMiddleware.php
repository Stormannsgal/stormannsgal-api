<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\AuthenticationFailureMessage;
use Stormannsgal\Core\Validator\AuthenticationValidator;

readonly class AuthenticationValidationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private AuthenticationValidator $validator,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = $request->getParsedBody();

        $this->validator->setData($data);

        if (!$this->validator->isValid()) {
            $message = AuthenticationFailureMessage::create(HTTP::STATUS_BAD_REQUEST, 'Invalid Data');

            return new JsonResponse($message, HTTP::STATUS_BAD_REQUEST);
        }

        return $handler->handle($request->withParsedBody($this->validator->getValues()));
    }
}
