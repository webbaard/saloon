<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Infra\Tab\Repository;


use Prooph\EventSourcing\Aggregate\AggregateRepository;
use Webbaard\Saloon\Domain\Tab\Repository\TabCollection;
use Webbaard\Saloon\Domain\Tab\Tab;
use Webbaard\Saloon\Domain\Tab\ValueObject\TabId;

final class TabRepository extends AggregateRepository implements TabCollection
{
    public function getTab(TabId $tabId): Tab
    {
        $this->getAggregateRoot($tabId->toString());
    }

    public function saveTab(Tab $tab): void
    {
        $this->saveAggregateRoot($tab);
    }
}