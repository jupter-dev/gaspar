<?php

namespace Presentation\Response;

use Domain\Entity\Distributor;

class DistributorResponse
{
    private string $id;
    private string $name;

    public function __construct(Distributor $distributor)
    {
        $this->id = $distributor->getId();
        $this->name = $distributor->getName();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
