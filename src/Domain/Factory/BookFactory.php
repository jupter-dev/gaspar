<?php

namespace Domain\Factory;

use Domain\Entity\Book;
use Domain\ValueObject\ISBN;

interface BookFactory
{
    public function create(
        string $id,
        string $name,
        ISBN $isbn,
        string $publisherId,
        string $writerId,
        string $distributorId
    ): Book;
}
