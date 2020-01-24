<?php
declare(strict_types=1);

namespace Webbaard\Saloon\Infra\Tab\Projection\Tab;

use Doctrine\DBAL\Connection;
use Webbaard\Saloon\Infra\Tab\Projection\Table;

class TabFinder
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll()
    {
        $tabs = $this->connection->fetchAll(
            sprintf(
                'SELECT * FROM %s',
                Table::TAB
            )
        );

        return $tabs;
    }

    public function findById($id)
    {

    }
}
