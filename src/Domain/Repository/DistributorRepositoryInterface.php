<?php

namespace Domain\Repository;

use Domain\Entity\Distributor;

interface DistributorRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $id): ?Distributor;

    public function save(Distributor $distributor): void;

    public function delete(string $id): void;
}
