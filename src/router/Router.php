<?php

namespace App\Router;

class Router
{
    public array $routes;

    public function get(string $path, string $controller)
    {
        $this->routes['GET'][] = new Route($path, $controller);
    }

    public function post(string $path, $controller)
    {
        $this->routes['POST'][] = new Route($path, $controller);
    }

    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($_SERVER['REQUEST_URI'])) {
                return $route->execute();
            }
        }
    }
}