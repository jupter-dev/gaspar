<?php

use Application\Routing\Router;

// Configuração
$config = require_once __DIR__ . '/../config/config.php';

$bookController = $config['bookController'];
$publisherController = $config['publisherController'];
$writerController = $config['writerController'];
$distributorController = $config['distributorController'];

// Configura o cabeçalho padrão
header('Content-Type: application/json');

// Cria as rotas
$router = new Router();

// Rotas de Livros (Books)
$router->addRoute('GET', '/^\/books$/', function () use ($bookController) {
    $books = $bookController->listBooks();
    echo json_encode(array_map(fn($book) => $book->toArray(), $books));
});

$router->addRoute('GET', '/^\/books\/([a-zA-Z0-9]+)$/', function ($id) use ($bookController) {
    $book = $bookController->getBook($id);
    echo json_encode($book->toArray());
});

$router->addRoute('POST', '/^\/books$/', function () use ($bookController) {
    $data = json_decode(file_get_contents('php://input'), true);
    $bookRequest = new \Presentation\Request\BookRequest($data);
    $book = $bookController->createBook($bookRequest);
    http_response_code(201);
    echo json_encode($book->toArray());
});

$router->addRoute('PUT', '/^\/books\/([a-zA-Z0-9]+)$/', function ($id) use ($bookController) {
    $data = json_decode(file_get_contents('php://input'), true);
    $bookRequest = new \Presentation\Request\BookRequest($data);
    $bookController->updateBook($id, $bookRequest);
    echo json_encode(['message' => 'Livro atualizado com sucesso.']);
});

$router->addRoute('DELETE', '/^\/books\/([a-zA-Z0-9]+)$/', function ($id) use ($bookController) {
    $bookController->deleteBook($id);
    echo json_encode(['message' => 'Livro deletado com sucesso.']);
});

// Rotas de Editoras (Publishers)
$router->addRoute('GET', '/^\/publishers$/', function () use ($publisherController) {
    $publishers = $publisherController->listPublishers();
    echo json_encode(array_map(fn($publisher) => $publisher->toArray(), $publishers));
});

$router->addRoute('POST', '/^\/publishers$/', function () use ($publisherController) {
    $data = json_decode(file_get_contents('php://input'), true);
    $publisher = $publisherController->createPublisher($data);
    http_response_code(201);
    echo json_encode($publisher->toArray());
});

$router->addRoute('DELETE', '/^\/publishers\/([a-zA-Z0-9]+)$/', function ($id) use ($publisherController) {
    $publisherController->deletePublisher($id);
    echo json_encode(['message' => 'Publisher deletado com sucesso.']);
});


// Rotas de Escritores (Writers)
$router->addRoute('GET', '/^\/writers$/', function () use ($writerController) {
    $writers = $writerController->listWriters();
    echo json_encode(array_map(fn($writer) => $writer->toArray(), $writers));
});

$router->addRoute('POST', '/^\/writers$/', function () use ($writerController) {
    $data = json_decode(file_get_contents('php://input'), true);
    $writer = $writerController->createWriter($data);
    http_response_code(201);
    echo json_encode($writer->toArray());
});

$router->addRoute('DELETE', '/^\/writers\/([a-zA-Z0-9]+)$/', function ($id) use ($writerController) {
    $writerController->deleteWriter($id);
    echo json_encode(['message' => 'Writer deletado com sucesso.']);
});


// Rotas de Distribuidores (Distributors)
$router->addRoute('GET', '/^\/distributors$/', function () use ($distributorController) {
    $distributors = $distributorController->listDistributors();
    echo json_encode(array_map(fn($distributor) => $distributor->toArray(), $distributors));
});

$router->addRoute('POST', '/^\/distributors$/', function () use ($distributorController) {
    $data = json_decode(file_get_contents('php://input'), true);
    $distributor = $distributorController->createDistributor($data);
    http_response_code(201);
    echo json_encode($distributor->toArray());
});

$router->addRoute('DELETE', '/^\/distributors\/([a-zA-Z0-9]+)$/', function ($id) use ($distributorController) {
    $distributorController->deleteDistributor($id);
    echo json_encode(['message' => 'Distributor deletado com sucesso.']);
});


// Processar a requisição
$router->handle($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);