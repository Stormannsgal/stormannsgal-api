<?php declare(strict_types=1);

namespace Stormannsgal;

use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{
    public function __invoke(): array
    {
        $aggregator = new ConfigAggregator([
            \App\ConfigProvider::class,
            \Core\ConfigProvider::class,
            \Game\ConfigProvider::class,
        ]);

        return $aggregator->getMergedConfig();
    }
}
