<?php declare(strict_types=1);

namespace AppTest\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Stormannsgal\App\DTO\ClientIdentification;
use Stormannsgal\App\DTO\ClientIdentificationData;
use Stormannsgal\App\DTO\RefreshToken;
use Stormannsgal\App\Hydrator\AccountHydrator;
use Stormannsgal\App\Hydrator\AccountHydratorInterface;
use Stormannsgal\App\Middleware\AccountAccessAuthPersistMiddleware;
use Stormannsgal\AppTest\Middleware\AbstractTestMiddleware;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Repository\AccountAccessAuthRepositoryInterface;
use Stormannsgal\Mock\Constants\Account;
use Stormannsgal\Mock\Repository\MockAccountAccessAuthRepository;

class AccountAccessAuthPersistMiddlewareTest extends AbstractTestMiddleware
{
    private AccountAccessAuthRepositoryInterface $repository;
    private AccountHydratorInterface $hydrator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new MockAccountAccessAuthRepository();
        $this->hydrator = new AccountHydrator();
    }

    public function testCanPersistAccountAccessAuth(): void
    {
        $middleware = new AccountAccessAuthPersistMiddleware($this->repository);
        $account = $this->hydrator->hydrate(Account::VALID_DATA);
        $clientData = ClientIdentificationData::create('1', 'default');
        $clientIdent = ClientIdentification::create($clientData, '1234');
        $refreshToken = RefreshToken::fromString('1234');

        $request = $this->request->withAttribute(AccountInterface::AUTHENTICATED, $account)
            ->withAttribute(ClientIdentification::class, $clientIdent)
            ->withAttribute(RefreshToken::class, $refreshToken);

        $response = $middleware->process($request, $this->handler);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertNotInstanceOf(JsonResponse::class, $response);
    }

    public function testFindMissingAccountEntity(): void
    {
        $middleware = new AccountAccessAuthPersistMiddleware($this->repository);

        $clientData = ClientIdentificationData::create('1', 'default');
        $clientIdent = ClientIdentification::create($clientData, '1234');
        $refreshToken = RefreshToken::fromString('1234');

        $request = $this->request->withAttribute(ClientIdentification::class, $clientIdent)
            ->withAttribute(RefreshToken::class, $refreshToken);

        $response = $middleware->process($request, $this->handler);

        $json = $this->getContentAsJson($response);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
        $this->assertJsonValueEquals($json, '$.statusCode', '400');
        $this->assertJsonValueEquals($json, '$.message', 'Invalid Data');
    }

    public function testFindMissingClientIdentification(): void
    {
        $middleware = new AccountAccessAuthPersistMiddleware($this->repository);

        $account = $this->hydrator->hydrate(Account::VALID_DATA);
        $refreshToken = RefreshToken::fromString('1234');

        $request = $this->request->withAttribute(AccountInterface::AUTHENTICATED, $account)
            ->withAttribute(RefreshToken::class, $refreshToken);

        $response = $middleware->process($request, $this->handler);

        $json = $this->getContentAsJson($response);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
        $this->assertJsonValueEquals($json, '$.statusCode', '400');
        $this->assertJsonValueEquals($json, '$.message', 'Invalid Data');
    }

    public function testFindMissingRefreshToken(): void
    {
        $middleware = new AccountAccessAuthPersistMiddleware($this->repository);

        $account = $this->hydrator->hydrate(Account::VALID_DATA);
        $clientData = ClientIdentificationData::create('1', 'default');
        $clientIdent = ClientIdentification::create($clientData, '1234');

        $request = $this->request->withAttribute(AccountInterface::AUTHENTICATED, $account)
            ->withAttribute(ClientIdentification::class, $clientIdent);

        $response = $middleware->process($request, $this->handler);

        $json = $this->getContentAsJson($response);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
        $this->assertJsonValueEquals($json, '$.statusCode', '400');
        $this->assertJsonValueEquals($json, '$.message', 'Invalid Data');
    }

    public function testAccountAccessAuthHasDuplicat(): void
    {
        $middleware = new AccountAccessAuthPersistMiddleware($this->repository);
        $account = $this->hydrator->hydrate(Account::INVALID_DATA);
        $clientData = ClientIdentificationData::create('1', 'default');
        $clientIdent = ClientIdentification::create($clientData, '1234');
        $refreshToken = RefreshToken::fromString('1234');

        $request = $this->request->withAttribute(AccountInterface::AUTHENTICATED, $account)
            ->withAttribute(ClientIdentification::class, $clientIdent)
            ->withAttribute(RefreshToken::class, $refreshToken);

        $response = $middleware->process($request, $this->handler);

        $json = $this->getContentAsJson($response);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(StatusCodeInterface::STATUS_BAD_REQUEST, $response->getStatusCode());
        $this->assertJsonValueEquals($json, '$.statusCode', '400');
        $this->assertJsonValueEquals($json, '$.message', 'Invalid Data');
    }
}
