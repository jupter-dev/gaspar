<?php

namespace Application\Controller;

use Application\Service\BookService;
use Presentation\Request\BookRequest;
use Presentation\Response\BookResponse;

class BookController
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function listBooks(): array
    {
        $books = $this->bookService->getAllBooks();

        return array_map(function ($book) {
            return new BookResponse($book);
        }, $books);
    }

    public function getBook(string $id): BookResponse
    {
        $book = $this->bookService->getBookById($id);

        if (!$book) {
            throw new \Exception("Livro não encontrado.");
        }

        return new BookResponse($book);
    }

    public function createBook(BookRequest $request): BookResponse
    {
        $data = $request->getData();

        $book = $this->bookService->createBook($data);

        return new BookResponse($book);
    }

    public function updateBook(string $id, BookRequest $request): void
    {
        $data = $request->getData();

        $this->bookService->updateBook($id, $data);
    }

    public function deleteBook(string $id): void
    {
        $this->bookService->deleteBook($id);
    }
}
