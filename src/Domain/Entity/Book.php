<?php

namespace Domain\Entity;

use Domain\ValueObject\ISBN;

class Book
{
    private string $id;
    private string $name;
    private ISBN $isbn;
    private string $publisherId;
    private string $writerId;
    private string $distributorId;

    public function __construct(
        string $id,
        string $name,
        ISBN $isbn,
        string $publisherId,
        string $writerId,
        string $distributorId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->isbn = $isbn;
        $this->publisherId = $publisherId;
        $this->writerId = $writerId;
        $this->distributorId = $distributorId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIsbn(): ISBN
    {
        return $this->isbn;
    }

    public function getPublisherId(): string
    {
        return $this->publisherId;
    }

    public function getWriterId(): string
    {
        return $this->writerId;
    }

    public function getDistributorId(): string
    {
        return $this->distributorId;
    }
}
