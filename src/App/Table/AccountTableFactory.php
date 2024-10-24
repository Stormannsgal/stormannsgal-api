<?php declare(strict_types=1);

namespace Stormannsgal\App\Table;

use Envms\FluentPDO\Query;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stormannsgal\App\Hydrator\AccountHydratorInterface;

readonly class AccountTableFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): AccountTable
    {
        $query = $container->get(Query::class);
        $hydrator = $container->get(AccountHydratorInterface::class);

        return new AccountTable($query, $hydrator);
    }
}
