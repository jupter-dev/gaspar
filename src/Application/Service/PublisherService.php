<?php

namespace Application\Service;

use Domain\Entity\Publisher;
use Domain\Repository\PublisherRepositoryInterface;

class PublisherService
{
    private PublisherRepositoryInterface $publisherRepository;

    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function getAllPublishers(): array
    {
        return $this->publisherRepository->findAll();
    }

    public function createPublisher(string $name): Publisher
    {
        $publisher = new Publisher(uniqid(), $name);
        $this->publisherRepository->save($publisher);
        return $publisher;
    }

    public function deletePublisher(string $id): void
    {
        $publisher = $this->publisherRepository->findById($id);
        if (!$publisher) {
            throw new \Exception("Publisher não encontrado.");
        }

        $this->publisherRepository->delete($id);
    }
}
