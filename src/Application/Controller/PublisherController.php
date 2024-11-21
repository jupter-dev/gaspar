<?php

namespace Application\Controller;

use Application\Service\PublisherService;

class PublisherController
{
    private PublisherService $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    public function listPublishers(): array
    {
        return $this->publisherService->getAllPublishers();
    }

    public function createPublisher(array $data)
    {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException("O campo 'name' é obrigatório.");
        }

        return $this->publisherService->createPublisher($data['name']);
    }

    public function deletePublisher(string $id): void
    {
        $this->publisherService->deletePublisher($id);
    }
}
