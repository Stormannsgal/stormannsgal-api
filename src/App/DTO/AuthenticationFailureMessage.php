<?php declare(strict_types=1);

namespace Stormannsgal\App\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema()]
readonly class AuthenticationFailureMessage
{
    public function __construct(
        #[OA\Property(
            description: 'The Http Status Code',
            type: 'integer',
        )]
        public int $statusCode,
        #[OA\Property(
            description: 'The Failure Message',
            type: 'string',
        )]
        public string $message,
    ) {
    }

    public static function create(int $statusCode, string $message): self
    {
        return new self($statusCode, $message);
    }
}
