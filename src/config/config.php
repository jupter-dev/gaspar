<?php

// Verifica se o autoload do Composer existe
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    // Configura o autoload manual
    spl_autoload_register(function ($class) {
        $baseDir = __DIR__ . '/..';
        $classPath = $baseDir . '/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($classPath)) {
            require_once $classPath;
        } else {
            die("Classe não encontrada: $classPath\n");
        }
    });
} else {
    // Caso o Composer esteja disponível, inclui o autoload do Composer
    require_once __DIR__ . '/../vendor/autoload.php';
}


// Configuração do Banco de Dados
try {
    $pdo = new \PDO('mysql:host=localhost;dbname=library_db', 'root', ''); 
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Instância de Repositórios
$bookRepository = new \Infrastructure\Persistence\BookRepository($pdo);
$publisherRepository = new \Infrastructure\Persistence\PublisherRepository($pdo);
$writerRepository = new \Infrastructure\Persistence\WriterRepository($pdo);
$distributorRepository = new \Infrastructure\Persistence\DistributorRepository($pdo);

// Instância de Fábricas
$bookFactory = new \Infrastructure\Factory\BookFactoryImpl();

// Instância de Serviços
$bookService = new \Application\Service\BookService($bookRepository, $bookFactory);
$publisherService = new \Application\Service\PublisherService($publisherRepository);
$writerService = new \Application\Service\WriterService($writerRepository);
$distributorService = new \Application\Service\DistributorService($distributorRepository);

// Instância de Controladores
$bookController = new \Application\Controller\BookController($bookService);
$publisherController = new \Application\Controller\PublisherController($publisherService);
$writerController = new \Application\Controller\WriterController($writerService);
$distributorController = new \Application\Controller\DistributorController($distributorService);

// Retorno das instâncias para o roteador
return [
    'bookController' => $bookController,
    'publisherController' => $publisherController,
    'writerController' => $writerController,
    'distributorController' => $distributorController,
];
