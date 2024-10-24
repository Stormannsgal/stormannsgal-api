<?php declare(strict_types=1);

namespace Stormannsgal\App\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema()]
readonly class RefreshToken
{
    public function __construct(
        #[OA\Property(
            description: 'The token after a valid log-in',
            type: 'string',
        )]
        public string $refreshToken,
    ) {
    }

    public static function fromString(string $token): self
    {
        return new self($token);
    }
}
