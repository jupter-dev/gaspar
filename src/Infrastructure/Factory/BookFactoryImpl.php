<?php

namespace Infrastructure\Factory;

use Domain\Entity\Book;
use Domain\Factory\BookFactory;
use Domain\ValueObject\ISBN;

class BookFactoryImpl implements BookFactory
{
    public function create(
        string $id,
        string $name,
        ISBN $isbn,
        string $publisherId,
        string $writerId,
        string $distributorId
    ): Book {
        return new Book($id, $name, $isbn, $publisherId, $writerId, $distributorId);
    }
}
