<?php

namespace Application\Controller;

use Application\Service\DistributorService;

class DistributorController
{
    private DistributorService $distributorService;

    public function __construct(DistributorService $distributorService)
    {
        $this->distributorService = $distributorService;
    }

    public function listDistributors(): array
    {
        return $this->distributorService->getAllDistributors();
    }

    public function createDistributor(array $data)
    {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException("O campo 'name' é obrigatório.");
        }

        return $this->distributorService->createDistributor($data['name']);
    }

    public function deleteDistributor(string $id): void
    {
        $this->distributorService->deleteDistributor($id);
    }
}
