<?php declare(strict_types=1);

namespace Stormannsgal\App\Table;

use Envms\FluentPDO\Query;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stormannsgal\App\Hydrator\AccountAccessAuthHydratorInterface;

readonly class AccountAccessAuthTableFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AccountAccessAuthTable
    {
        $query = $container->get(Query::class);
        $hydrator = $container->get(AccountAccessAuthHydratorInterface::class);

        return new AccountAccessAuthTable($query, $hydrator);
    }
}
