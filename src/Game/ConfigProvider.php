<?php declare(strict_types=1);

namespace Game;

use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{
    public function __invoke(): array
    {
        $aggregator = new ConfigAggregator([
            Shared\ConfigProvider::class,
            Character\ConfigProvider::class,
            Location\ConfigProvider::class,
        ]);

        return $aggregator->getMergedConfig();
    }
}
