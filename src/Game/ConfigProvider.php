<?php declare(strict_types=1);

namespace Game;

use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{
    public function __invoke(): array
    {
        $aggregator = new ConfigAggregator([
            Game\Shared\ConfigProvider::class,
            Game\Character\ConfigProvider::class,
        ]);

        return $aggregator->getMergedConfig();
    }
}
