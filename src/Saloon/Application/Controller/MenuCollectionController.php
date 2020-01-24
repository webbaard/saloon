<?php
declare(strict_types=1);

namespace Webbaard\Saloon\Application\Controller;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Webbaard\Saloon\Infra\Tab\Projection\Tab\TabFinder;

final class MenuCollectionController
{
    public function collectionAction(): Response
    {
        return new JsonResponse([
            'Whiskey',
            'Beer',
            'Gin',
            'Bourbon',
            'Wine',
            'Milk'
        ]);
    }
}
