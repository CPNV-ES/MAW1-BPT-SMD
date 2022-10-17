<?php

namespace App\Router;

class Router
{
    private static ?Router $instance = null;

    public array $routes;

    private function __construct() {}

    /**
     * @return Router
     */
    public static function getInstance(): Router
    {
        if (self::$instance == null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    /**
     * @param string $name
     * @param Route  $route
     *
     * @return void
     */
    public function add(string $name, Route $route): void
    {
        $this->routes[$name] = $route;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        foreach ($this->routes as $route) {
            if ($route->matches($_SERVER['REQUEST_URI'])) {
                $route->execute();
            }
        }
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return string
     */
    public function generateUrl(string $name, array $params = []): string
    {
        $path = '/' . $this->routes[$name]->getPath();

        foreach ($params as $key => $param) {
            $path = str_replace(':' . $key, $param, $path);
        }

        return $path;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return void
     */
    public function redirect(string $name, array $params = []): void
    {
        $location = $this->generateUrl($name, $params);
        header("Location: {$location}");
    }
}