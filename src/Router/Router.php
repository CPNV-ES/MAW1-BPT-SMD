<?php

namespace App\Router;

use PharIo\Manifest\InvalidUrlException;

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
    public function get(string $name, Route $route): void
    {
        $this->routes['GET'][$name] = $route;
    }

    /**
     * @param string $name
     * @param Route  $route
     *
     * @return void
     */
    public function post(string $name, Route $route): void
    {
        $this->routes['POST'][$name] = $route;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
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
    public function generateUrl(string $name, array $params = [], string $query = ''): string
    {
        foreach ($this->routes as $routes) {
            if (isset($routes[$name])) {
                $path = '/' . $routes[$name]->getPath();

                foreach ($params as $key => $param) {
                    $path = str_replace(':' . $key, $param, $path);
                }

                return $path . ($query ? '?' . $query : '');
            }
        }
        throw new InvalidUrlException();
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