<?php

namespace Application\Routing;

class Router
{
    private array $routes = [];

    public function addRoute(string $method, string $path, callable $handler): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
        ];
    }

    public function handle(string $method, string $uri): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && preg_match($route['path'], $uri, $matches)) {
                array_shift($matches); // Remove a URI completa
                call_user_func_array($route['handler'], $matches);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada.']);
    }
}
