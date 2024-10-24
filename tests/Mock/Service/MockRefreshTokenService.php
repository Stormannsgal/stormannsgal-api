<?php declare(strict_types=1);

namespace Stormannsgal\Mock\Service;

use Stormannsgal\App\DTO\ClientIdentification;
use Stormannsgal\App\DTO\JwtTokenConfig;
use Stormannsgal\App\Service\RefreshTokenService;

readonly class MockRefreshTokenService extends RefreshTokenService
{
    public function __construct()
    {
        $config = new JwtTokenConfig('1', '1', 1, '1', '1');

        parent::__construct($config);
    }

    public function generate(ClientIdentification $clientIdentification): string
    {
        return 'test successfully';
    }
}
