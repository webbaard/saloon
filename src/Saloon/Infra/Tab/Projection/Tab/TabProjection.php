<?php
declare(strict_types=1);

namespace Webbaard\Saloon\Infra\Tab\Projection\Tab;

use Prooph\Bundle\EventStore\Projection\ReadModelProjection;
use Prooph\EventStore\Projection\ReadModelProjector;
use Webbaard\Saloon\Domain\Tab\Event\TabIsOpened;

final class TabProjection implements ReadModelProjection
{
    /**
     * @param ReadModelProjector $projector
     * @return ReadModelProjector
     */
    public function project(ReadModelProjector $projector): ReadModelProjector
    {
        $projector->fromStream('event_stream')
            ->init(function (): array {
                return [];
            })
            ->when([
            ]);

        return $projector;
    }
}
