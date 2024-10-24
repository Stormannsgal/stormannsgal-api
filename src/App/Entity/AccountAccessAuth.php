<?php declare(strict_types=1);

namespace Stormannsgal\App\Entity;

use DateTimeImmutable;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;
use Stormannsgal\Core\Trait\CloneReadonlyClassWith;
use Stormannsgal\Core\Utils\Collectible;

readonly class AccountAccessAuth implements AccountAccessAuthInterface, Collectible
{
    use CloneReadonlyClassWith;

    public function __construct(
        private int $id,
        private int $userId,
        private string $label,
        private string $refreshToken,
        private string $userAgent,
        private string $clientIdentHash,
        private DateTimeImmutable $createdAt,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getClientIdentHash(): string
    {
        return $this->clientIdentHash;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
