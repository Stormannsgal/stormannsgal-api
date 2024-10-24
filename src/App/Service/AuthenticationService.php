<?php declare(strict_types=1);

namespace Stormannsgal\App\Service;

readonly class AuthenticationService
{
    public function isPasswordMatch(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
