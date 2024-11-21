<?php

namespace Application\Service;

use Domain\Entity\Distributor;
use Domain\Repository\DistributorRepositoryInterface;

class DistributorService
{
    private DistributorRepositoryInterface $distributorRepository;

    public function __construct(DistributorRepositoryInterface $distributorRepository)
    {
        $this->distributorRepository = $distributorRepository;
    }

    public function getAllDistributors(): array
    {
        return $this->distributorRepository->findAll();
    }

    public function createDistributor(string $name): Distributor
    {
        $distributor = new Distributor(uniqid(), $name);
        $this->distributorRepository->save($distributor);
        return $distributor;
    }

    public function deleteDistributor(string $id): void
    {
        $distributor = $this->distributorRepository->findById($id);
        if (!$distributor) {
            throw new \Exception("Distributor não encontrado.");
        }

        $this->distributorRepository->delete($id);
    }
}
