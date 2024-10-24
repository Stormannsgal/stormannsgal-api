<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\AuthenticationFailureMessage;
use Stormannsgal\App\Service\AuthenticationService;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Repository\AccountRepositoryInterface;
use Stormannsgal\Core\Type\Email;

readonly class AuthenticationMiddleware implements MiddlewareInterface
{
    public function __construct(
        private AuthenticationService $service,
        private AccountRepositoryInterface $repository,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = $request->getParsedBody();

        $email = new Email($data['email']);

        $account = $this->repository->findByEmail($email);

        if (!($account instanceof AccountInterface)) {
            $message = AuthenticationFailureMessage::create(HTTP::STATUS_BAD_REQUEST, 'Invalid Data');

            return new JsonResponse($message, $message->statusCode);
        }

        if (!$this->service->isPasswordMatch($data['password'], $account->getPasswordHash())) {
            $message = AuthenticationFailureMessage::create(HTTP::STATUS_BAD_REQUEST, 'Invalid Data');

            return new JsonResponse($message, $message->statusCode);
        }

        return $handler->handle($request->withAttribute(AccountInterface::AUTHENTICATED, $account));
    }
}
