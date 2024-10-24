<?php declare(strict_types=1);

namespace Stormannsgal\App\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema()]
readonly class AccessToken
{
    public function __construct(
        #[OA\Property(
            description: 'The Token for authorized access',
            type: 'string',
        )]
        public string $accessToken,
    ) {
    }

    public static function fromString(string $token): self
    {
        return new self($token);
    }
}
