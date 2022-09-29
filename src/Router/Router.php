<?php

namespace App\Router;

class Router
{
    private static ?Router $instance = null;

    public array $routes;

    private function __construct () {}

    /**
     * @return Router
     */
    public static function getInstance (): Router
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    /**
     * @param string $path
     * @param string $controller
     *
     * @return void
     */
    public function get (string $path, string $controller): void
    {
        $this->routes['GET'][] = new Route($path, $controller);
    }

    /**
     * @param string $path
     * @param string $controller
     *
     * @return void
     */
    public function post (string $path, string $controller): void
    {
        $this->routes['POST'][] = new Route($path, $controller);
    }

    /**
     * @return void
     */
    public function run (): void
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($_SERVER['REQUEST_URI'])) {
                $route->execute();
            }
        }
    }
}