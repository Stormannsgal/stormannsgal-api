<?php declare(strict_types=1);

namespace Stormannsgal\App\Service;

use Psr\Container\ContainerInterface;
use Stormannsgal\App\DTO\JwtTokenConfig;

readonly class RefreshTokenServiceFactory
{
    public function __invoke(ContainerInterface $container): RefreshTokenService
    {
        $jwtTokenConfig = $container->get('config')['jwt_token']['refresh'];
        $jwtTokenConfig = JwtTokenConfig::createFromArray($jwtTokenConfig);

        return new RefreshTokenService($jwtTokenConfig);
    }
}
