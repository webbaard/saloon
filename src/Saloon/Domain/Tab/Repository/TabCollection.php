<?php


namespace Webbaard\Saloon\Domain\Tab\Repository;


use Webbaard\Saloon\Domain\Tab\Tab;
use Webbaard\Saloon\Domain\Tab\ValueObject\TabId;

interface TabCollection
{
    public function getTab(TabId $tabId): Tab;

    public function saveTab(Tab $tab): void;
}