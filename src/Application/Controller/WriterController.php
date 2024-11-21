<?php

namespace Application\Controller;

use Application\Service\WriterService;

class WriterController
{
    private WriterService $writerService;

    public function __construct(WriterService $writerService)
    {
        $this->writerService = $writerService;
    }

    public function listWriters(): array
    {
        return $this->writerService->getAllWriters();
    }

    public function createWriter(array $data)
    {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException("O campo 'name' é obrigatório.");
        }

        return $this->writerService->createWriter($data['name']);
    }

    public function deleteWriter(string $id): void
    {
        $this->writerService->deleteWriter($id);
    }
}
