<?php declare(strict_types=1);

namespace Stormannsgal\App\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(required: ['email', 'password'])]
readonly class AccountAuthenticationData
{
    #[OA\Property(
        description: 'The E-Mail from Account',
        type: 'string',
    )]
    public string $email;

    #[OA\Property(
        description: 'The Password from Account',
        type: 'string',
    )]
    public string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
