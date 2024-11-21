<?php

namespace Presentation\Response;

use Domain\Entity\Writer;

class WriterResponse
{
    private string $id;
    private string $name;

    public function __construct(Writer $writer)
    {
        $this->id = $writer->getId();
        $this->name = $writer->getName();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
