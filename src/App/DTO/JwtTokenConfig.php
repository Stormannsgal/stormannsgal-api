<?php declare(strict_types=1);

namespace Stormannsgal\App\DTO;

readonly class JwtTokenConfig
{
    public function __construct(
        public string $iss,
        public string $aud,
        public int $duration,
        public string $algorithmus,
        public string $key,
    ) {
    }

    public static function createFromArray(array $config): self
    {
        return new self(
            $config['iss'],
            $config['aud'],
            (int)$config['duration'],
            $config['algorithmus'],
            $config['key'],
        );
    }
}
