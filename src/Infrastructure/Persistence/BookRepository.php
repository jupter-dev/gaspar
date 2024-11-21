<?php

namespace Infrastructure\Persistence;

use Domain\Entity\Book;
use Domain\Repository\BookRepositoryInterface;
use Domain\ValueObject\ISBN;

class BookRepository implements BookRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM books");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return array_map(function ($row) {
            return new Book(
                $row['id'],
                $row['name'],
                new ISBN($row['isbn']),
                $row['publisher_id'],
                $row['writer_id'],
                $row['distributor_id']
            );
        }, $result);
    }

    public function findById(string $id): ?Book
    {
        $stmt = $this->connection->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Book(
            $row['id'],
            $row['name'],
            new ISBN($row['isbn']),
            $row['publisher_id'],
            $row['writer_id'],
            $row['distributor_id']
        );
    }

    public function save(Book $book): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO books (id, name, isbn, publisher_id, writer_id, distributor_id)
            VALUES (:id, :name, :isbn, :publisherId, :writerId, :distributorId)
        ");
        $stmt->execute([
            'id' => $book->getId(),
            'name' => $book->getName(),
            'isbn' => $book->getIsbn()->getValue(),
            'publisherId' => $book->getPublisherId(),
            'writerId' => $book->getWriterId(),
            'distributorId' => $book->getDistributorId(),
        ]);
    }

    public function update(Book $book): void
    {
        $stmt = $this->connection->prepare("
            UPDATE books
            SET name = :name, isbn = :isbn, publisher_id = :publisherId, 
                writer_id = :writerId, distributor_id = :distributorId
            WHERE id = :id
        ");
        $stmt->execute([
            'id' => $book->getId(),
            'name' => $book->getName(),
            'isbn' => $book->getIsbn()->getValue(),
            'publisherId' => $book->getPublisherId(),
            'writerId' => $book->getWriterId(),
            'distributorId' => $book->getDistributorId(),
        ]);
    }

    public function delete(string $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
