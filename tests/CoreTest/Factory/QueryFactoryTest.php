<?php declare(strict_types=1);

namespace Stormannsgal\CoreTest\Factory;

use Envms\FluentPDO\Query;
use PDO;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stormannsgal\Core\Factory\QueryFactory;
use Stormannsgal\Mock\Database\MockPDO;
use Stormannsgal\Mock\MockContainer;

class QueryFactoryTest extends TestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testCanCreateQueryInstance(): void
    {
        $container = new MockContainer();
        $container->add(PDO::class, new MockPDO());

        $query = (new QueryFactory())($container);

        $this->assertInstanceOf(Query::class, $query);
    }
}
