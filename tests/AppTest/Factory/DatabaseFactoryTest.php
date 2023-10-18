<?php declare(strict_types=1);

namespace AppTest\Factory;

use App\Factory\DatabaseFactory;
use AppTest\Mock\MockContainer;
use PDO;
use PDOException;
use PHPUnit\Framework\TestCase;

class DatabaseFactoryTest extends TestCase
{
    public function testThrowPDOException(): void
    {
        $this->expectException(PDOException::class);

        $config = [
            'database' => [
                'user' => 'testUser',
                'password' => 'testPassword',
                'host' => 'https//example.com',
                'port' => 3306,
                'dbname' => 'example_db',
                'error' => PDO::ERRMODE_EXCEPTION,

            ],
        ];

        $container = new MockContainer();
        $container->add('config', $config);

        $pdo = (new DatabaseFactory())($container);

        $this->assertInstanceOf(PDO::class, $pdo);
    }
}
