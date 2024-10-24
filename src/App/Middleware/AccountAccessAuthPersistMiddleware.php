<?php declare(strict_types=1);

namespace Stormannsgal\App\Middleware;

use DateTimeImmutable;
use Fig\Http\Message\StatusCodeInterface as HTTP;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Stormannsgal\App\DTO\AuthenticationFailureMessage;
use Stormannsgal\App\DTO\ClientIdentification;
use Stormannsgal\App\DTO\RefreshToken;
use Stormannsgal\App\Entity\AccountAccessAuth;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Exception\DuplicateEntryException;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;

readonly class AccountAccessAuthPersistMiddleware implements MiddlewareInterface
{
    public function __construct(
        private AccountAccessAuthRepositoryInterface $repository,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var AccountInterface $account */
        $account = $request->getAttribute(AccountInterface::AUTHENTICATED);

        /** @var ClientIdentification $clientIdent */
        $clientIdent = $request->getAttribute(ClientIdentification::class);

        /** @var RefreshToken $refreshToken */
        $refreshToken = $request->getAttribute(RefreshToken::class);

        // @phpstan-ignore-next-line
        if ($account === null || $clientIdent === null || $refreshToken === null) {
            $message = AuthenticationFailureMessage::create(HTTP::STATUS_BAD_REQUEST, 'Invalid Data');

            return new JsonResponse($message, HTTP::STATUS_BAD_REQUEST);
        }

        $accountAccessAuth = new AccountAccessAuth(
            1,
            $account->getId(),
            'default',
            $refreshToken->refreshToken,
            $clientIdent->clientIdentificationData->userAgent,
            $clientIdent->identificationHash,
            new DateTimeImmutable()
        );
        try {
            $this->repository->insert($accountAccessAuth);
        } catch (DuplicateEntryException $e) {
            $message = AuthenticationFailureMessage::create(HTTP::STATUS_BAD_REQUEST, 'Invalid Data');

            return new JsonResponse($message, HTTP::STATUS_BAD_REQUEST);
        }

        return $handler->handle($request);
    }
}
