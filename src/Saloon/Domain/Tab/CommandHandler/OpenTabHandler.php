<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Domain\Tab\CommandHandler;


use Webbaard\Saloon\Domain\Tab\Command\OpenTab;
use Webbaard\Saloon\Domain\Tab\Repository\TabCollection;
use Webbaard\Saloon\Domain\Tab\Tab;

final class OpenTabHandler
{
    private TabCollection $tabCollection;

    public function __construct(TabCollection $tabCollection)
    {
        $this->tabCollection = $tabCollection;
    }

    public function __invoke(OpenTab $command)
    {
        $this->tabCollection->saveTab(Tab::forCustomer($command->customerName()));
    }
}