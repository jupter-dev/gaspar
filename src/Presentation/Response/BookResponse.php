<?php

namespace Presentation\Response;

use Domain\Entity\Book;

class BookResponse
{
    private string $id;
    private string $name;
    private string $isbn;
    private string $publisherId;
    private string $writerId;
    private string $distributorId;

    public function __construct(Book $book)
    {
        $this->id = $book->getId();
        $this->name = $book->getName();
        $this->isbn = $book->getIsbn()->getValue();
        $this->publisherId = $book->getPublisherId();
        $this->writerId = $book->getWriterId();
        $this->distributorId = $book->getDistributorId();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isbn' => $this->isbn,
            'publisherId' => $this->publisherId,
            'writerId' => $this->writerId,
            'distributorId' => $this->distributorId,
        ];
    }
}
