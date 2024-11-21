<?php

namespace Infrastructure\Persistence;

use Domain\Entity\Writer;
use Domain\Repository\WriterRepositoryInterface;

class WriterRepository implements WriterRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM writers");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Writer($row['id'], $row['name']), $rows);
    }

    public function findById(string $id): ?Writer
    {
        $stmt = $this->connection->prepare("SELECT * FROM writers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Writer($row['id'], $row['name']);
    }

    public function save(Writer $writer): void
    {
        $stmt = $this->connection->prepare("INSERT INTO writers (id, name) VALUES (:id, :name)");
        $stmt->execute([
            'id' => $writer->getId(),
            'name' => $writer->getName(),
        ]);
    }

    public function delete(string $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM writers WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
