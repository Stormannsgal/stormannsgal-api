<?php declare(strict_types=1);

namespace Stormannsgal\Game;

use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{
    public function __invoke(): array
    {
        $aggregator = new ConfigAggregator([
            \Stormannsgal\Game\Shared\ConfigProvider::class,
        ]);

        return $aggregator->getMergedConfig();
    }
}
