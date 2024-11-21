<?php

namespace Presentation\Request;

class BookRequest
{
    private array $data;

    public function __construct(array $data)
    {
        // Aqui você pode adicionar validações dos dados recebidos
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
