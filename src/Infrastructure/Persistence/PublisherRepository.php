<?php

namespace Infrastructure\Persistence;

use Domain\Entity\Publisher;
use Domain\Repository\PublisherRepositoryInterface;

class PublisherRepository implements PublisherRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM publishers");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Publisher($row['id'], $row['name']), $rows);
    }

    public function findById(string $id): ?Publisher
    {
        $stmt = $this->connection->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Publisher($row['id'], $row['name']);
    }

    public function save(Publisher $publisher): void
    {
        $stmt = $this->connection->prepare("INSERT INTO publishers (id, name) VALUES (:id, :name)");
        $stmt->execute([
            'id' => $publisher->getId(),
            'name' => $publisher->getName(),
        ]);
    }

    public function delete(string $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
