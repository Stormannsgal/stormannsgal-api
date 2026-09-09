<?php declare(strict_types=1);

namespace App;

use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{
    public function __invoke(): array
    {
        $aggregator = new ConfigAggregator([
            Account\ConfigProvider::class,
            Mailing\ConfigProvider::class,
            Token\ConfigProvider::class,
        ]);

        return $aggregator->getMergedConfig();
    }
}
