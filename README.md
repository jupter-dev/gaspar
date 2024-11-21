# **Library Management API**

Uma API simples para gerenciar **livros**, **editoras**, **escritores** e **distribuidores**, desenvolvida em PHP seguindo os princípios **SOLID** e boas práticas de arquitetura.

---

### **Boas Práticas Adotadas**
- SOLID: A aplicação segue os princípios SOLID para garantir a organização e escalabilidade.
- Padrão de Projeto Factory: Usado para centralizar a criação de objetos.
- Camadas: O código é organizado em camadas claras: Controller, Service, Repository, Entity.

---

## **Estrutura do Projeto**

O projeto segue uma organização modular para facilitar a manutenção e as futuras atualizações:

```
src/
├── Application/
│   ├── Controller/
│   ├── Service/
├── Domain/
│   ├── Entity/
│   ├── Factory/
│   ├── Repository/
├── Infrastructure/
│   ├── Factory/
│   ├── Persistence/
├── config/
│   ├── config.php
└── public/
    ├── index.php

```

---

## **Funcionalidades**

- **Livros (Books)**:
  - Criar, listar, buscar, atualizar e deletar livros.
- **Editoras (Publishers)**:
  - Criar, listar e deletar editoras.
- **Escritores (Writers)**:
  - Criar, listar e deletar escritores.
- **Distribuidores (Distributors)**:
  - Criar, listar e deletar distribuidores.


## **Requisitos**

- **PHP 7.4+**
- **Servidor Web** (ex.: Apache, Nginx)
- **Banco de Dados MySQL**
- Composer (opcional)

---

## **Configuração do Ambiente**

### **1. Clonar o Repositório**
```bash
git clone https://github.com/seu-repositorio/library-management-api.git
cd library-management-api
```

### **2. Configurar o Banco de Dados**
Crie o banco de dados e as tabelas necessárias:

```mysql
    CREATE DATABASE library_db;
    
    USE library_db;
    
    CREATE TABLE books (
        id VARCHAR(36) PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        isbn VARCHAR(13) NOT NULL,
        publisher_id VARCHAR(36),
        writer_id VARCHAR(36),
        distributor_id VARCHAR(36)
    );
    
    CREATE TABLE publishers (
        id VARCHAR(36) PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    );
    
    CREATE TABLE writers (
        id VARCHAR(36) PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    );
    
    CREATE TABLE distributors (
        id VARCHAR(36) PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    );
```

### **3. Configurar o Projeto**
Edite o arquivo ```config/config.php``` para definir as configurações do banco de dados:

```php
$pdo = new \PDO('mysql:host=localhost;dbname=library_db', 'root', '');
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
```

### **4. Rodar o Servidor**
Inicie o servidor embutido do PHP:
```bash
php -S localhost:8000 -t src/public
```

---
## **Configuração de Virtual Host (Caso necessário)**
Adicione o seguinte bloco ao arquivo de configuração do Apache (`httpd-vhosts.conf`), que geralmente está localizado em `C:/xampp/apache/conf/extra/httpd-vhosts.conf` (em XAMPP) ou `/etc/apache2/sites-available/` (em servidores Linux):
```
<VirtualHost *:80> 
    DocumentRoot "CAMINHO_COMPLETO_PARA_SEU_PROJETO/public" 
    ServerName localhost 
    <Directory "CAMINHO_COMPLETO_PARA_SEU_PROJETO/public"> 
        Options Indexes FollowSymLinks 
        AllowOverride All 
        Require all granted 
    </Directory>
</VirtualHost>
```

---

## **ENDPOINTS**

### **Livros (Books)**

| Método  | Endpoint      | Descrição                |
|---------|---------------|--------------------------|
| GET     | `/books`      | Lista todos os livros    |
| GET     | `/books/{id}` | Busca um livro pelo ID   |
| POST    | `/books`      | Cria um novo livro       |
| PUT     | `/books/{id}` | Atualiza um livro pelo ID|
| DELETE  | `/books/{id}` | Deleta um livro pelo ID  |

---

### **Editoras (Publishers)**

| Método  | Endpoint          | Descrição                |
|---------|-------------------|--------------------------|
| GET     | `/publishers`     | Lista todas as editoras  |
| POST    | `/publishers`     | Cria uma nova editora    |
| DELETE  | `/publishers/{id}`| Deleta uma editora pelo ID|

---

### **Escritores (Writers)**

| Método  | Endpoint       | Descrição                  |
|---------|----------------|----------------------------|
| GET     | `/writers`     | Lista todos os escritores  |
| POST    | `/writers`     | Cria um novo escritor      |
| DELETE  | `/writers/{id}`| Deleta um escritor pelo ID |

---

### **Distribuidores (Distributors)**

| Método  | Endpoint          | Descrição                     |
|---------|-------------------|-------------------------------|
| GET     | `/distributors`   | Lista todos os distribuidores |
| POST    | `/distributors`   | Cria um novo distribuidor     |
| DELETE  | `/distributors/{id}`| Deleta um distribuidor pelo ID |

---

### Exemplos de Uso
**Criar um Livro** (utilize JSON)

POST ```/books```

```json
{
    "name": "O Senhor dos Anéis",
    "isbn": "9781234567890",
    "publisherId": "1",
    "writerId": "2",
    "distributorId": "3"
}
``` 
