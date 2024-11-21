<?php

namespace Domain\Repository;

use Domain\Entity\Book;

interface BookRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $id): ?Book;

    public function save(Book $book): void;

    public function update(Book $book): void;
    
    public function delete(string $id): void;
}
