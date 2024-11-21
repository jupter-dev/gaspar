<?php

namespace Infrastructure\Persistence;

use Domain\Entity\Distributor;
use Domain\Repository\DistributorRepositoryInterface;

class DistributorRepository implements DistributorRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM distributors");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Distributor($row['id'], $row['name']), $rows);
    }

    public function findById(string $id): ?Distributor
    {
        $stmt = $this->connection->prepare("SELECT * FROM distributors WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Distributor($row['id'], $row['name']);
    }

    public function save(Distributor $distributor): void
    {
        $stmt = $this->connection->prepare("INSERT INTO distributors (id, name) VALUES (:id, :name)");
        $stmt->execute([
            'id' => $distributor->getId(),
            'name' => $distributor->getName(),
        ]);
    }

    public function delete(string $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM distributors WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
