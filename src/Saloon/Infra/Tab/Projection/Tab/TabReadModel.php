<?php
declare(strict_types=1);

namespace Webbaard\Saloon\Infra\Tab\Projection\Tab;

use Doctrine\DBAL\Connection;
use Prooph\EventStore\Projection\AbstractReadModel;
use Webbaard\Saloon\Infra\Tab\Projection\Table;

class TabReadModel extends AbstractReadModel
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function init(): void
    {
        $tableName = Table::TAB;
        $sql = <<<EOT
CREATE TABLE `$tableName` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `customerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
EOT;
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function isInitialized(): bool
    {
        $tableName = Table::TAB;
        $sql = "SHOW TABLES LIKE '$tableName';";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch();
        if (false === $result) {
            return false;
        }

        return true;
    }

    public function reset(): void
    {
        $tableName = Table::TAB;
        $sql = "DROP TABLE IF EXISTS $tableName;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    public function delete(): void
    {
        $tableName = Table::TAB;
        $sql = "DROP TABLE IF EXISTS $tableName;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    protected function update(array $data): void
    {
        $this->connection->update(Table::TAB, $data, ['id' => $data['id']]);
    }

    protected function insert(array $data): void
    {
        $this->connection->insert(Table::TAB, $data);

    }

    protected function remove(array $data): void
    {
        $this->connection->delete(Table::TAB, ['id' => $data['id']]);
    }
}
