<?php declare(strict_types=1);

namespace Stormannsgal\App\Service;

use Firebase\JWT\JWT;
use Stormannsgal\App\DTO\JwtTokenConfig;
use Stormannsgal\Core\Entity\AccountInterface;

use function time;

readonly class AccessTokenService
{
    public function generate(JwtTokenConfig $config, AccountInterface $account): string
    {
        $now = time();

        $payload = [
            'iss' => $config->iss,
            'aud' => $config->aud,
            'iat' => $now,
            'exp' => $now + $config->duration,
            'uuid' => $account->getUuid()->getHex()->toString(),
        ];

        return JWT::encode($payload, $config->key, $config->algorithmus);
    }
}
