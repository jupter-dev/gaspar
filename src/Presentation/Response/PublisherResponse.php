<?php

namespace Presentation\Response;

use Domain\Entity\Publisher;

class PublisherResponse
{
    private string $id;
    private string $name;

    public function __construct(Publisher $publisher)
    {
        $this->id = $publisher->getId();
        $this->name = $publisher->getName();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
