<?php

namespace Application\Service;

use Domain\Entity\Book;
use Domain\Factory\BookFactory;
use Domain\Repository\BookRepositoryInterface;
use Domain\ValueObject\ISBN;

class BookService
{
    private BookRepositoryInterface $bookRepository;
    private BookFactory $bookFactory;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        BookFactory $bookFactory
    ) {
        $this->bookRepository = $bookRepository;
        $this->bookFactory = $bookFactory;
    }

    public function getAllBooks(): array
    {
        return $this->bookRepository->findAll();
    }

    public function getBookById(string $id): ?Book
    {
        return $this->bookRepository->findById($id);
    }

    public function createBook(array $data): Book
    {
        $isbn = new ISBN($data['isbn']);

        $book = $this->bookFactory->create(
            uniqid(),
            $data['name'],
            $isbn,
            $data['publisherId'],
            $data['writerId'],
            $data['distributorId']
        );

        $this->bookRepository->save($book);

        return $book;
    }

    public function updateBook(string $id, array $data): void
    {
        $book = $this->bookRepository->findById($id);

        if (!$book) {
            throw new \Exception("Livro não encontrado.");
        }


        $updatedBook = $this->bookFactory->create(
            $book->getId(),
            $data['name'] ?? $book->getName(),
            new ISBN($data['isbn'] ?? $book->getIsbn()->getValue()),
            $data['publisherId'] ?? $book->getPublisherId(),
            $data['writerId'] ?? $book->getWriterId(),
            $data['distributorId'] ?? $book->getDistributorId()
        );

        $this->bookRepository->update($updatedBook);
    }

    public function deleteBook(string $id): void
    {
        $this->bookRepository->delete($id);
    }
}
