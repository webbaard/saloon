<?php

declare(strict_types=1);


namespace Webbaard\Saloon\Application\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Webbaard\Saloon\Domain\Tab\Repository\TabCollection;
use Webbaard\Saloon\Domain\Tab\ValueObject\TabId;

final class TabController
{
    private TabCollection $tabCollection;

    public function __construct(TabCollection $tabCollection)
    {
        $this->tabCollection = $tabCollection;
    }

    public function detailsAction(string $id): JsonResponse
    {
        $tab = $this->tabCollection->getTab(TabId::fromString($id));
        return new JsonResponse($tab->payload());
    }
}