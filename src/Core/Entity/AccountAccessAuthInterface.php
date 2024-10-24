<?php declare(strict_types=1);

namespace Stormannsgal\Core\Entity;

use DateTimeImmutable;

interface AccountAccessAuthInterface
{
    public function getId(): int;

    public function getUserId(): int;

    public function getLabel(): string;

    public function getRefreshToken(): string;

    public function getUserAgent(): string;

    public function getClientIdentHash(): string;

    public function getCreatedAt(): DateTimeImmutable;
}
