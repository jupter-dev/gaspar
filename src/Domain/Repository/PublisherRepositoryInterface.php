<?php

namespace Domain\Repository;

use Domain\Entity\Publisher;

interface PublisherRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $id): ?Publisher;

    public function save(Publisher $publisher): void;

    public function delete(string $id): void;
}
