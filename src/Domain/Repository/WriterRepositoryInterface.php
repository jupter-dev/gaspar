<?php

namespace Domain\Repository;

use Domain\Entity\Writer;

interface WriterRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $id): ?Writer;

    public function save(Writer $writer): void;

    public function delete(string $id): void;
}
