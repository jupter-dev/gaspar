<?php

namespace Presentation\Request;

class PublisherRequest
{
    private string $name;

    public function __construct(array $data)
    {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException('O nome do Publisher é obrigatório.');
        }

        $this->name = $data['name'];
    }

    public function getName(): string
    {
        return $this->name;
    }
}
