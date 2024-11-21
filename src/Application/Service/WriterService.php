<?php

namespace Application\Service;

use Domain\Entity\Writer;
use Domain\Repository\WriterRepositoryInterface;

class WriterService
{
    private WriterRepositoryInterface $writerRepository;

    public function __construct(WriterRepositoryInterface $writerRepository)
    {
        $this->writerRepository = $writerRepository;
    }

    public function getAllWriters(): array
    {
        return $this->writerRepository->findAll();
    }

    public function createWriter(string $name): Writer
    {
        $writer = new Writer(uniqid(), $name);
        $this->writerRepository->save($writer);
        return $writer;
    }

    public function deleteWriter(string $id): void
    {
        $writer = $this->writerRepository->findById($id);
        if (!$writer) {
            throw new \Exception("Writer não encontrado.");
        }

        $this->writerRepository->delete($id);
    }
}
