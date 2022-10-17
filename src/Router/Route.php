<?php

namespace App\Router;

use App\Database\DBConnection;

class Route
{
    protected string $path;
    protected string $controller;
    protected string $method;
    protected array  $matches;

    /**
     * @param string $path
     * @param string $controller
     * @param string $method
     */
    public function __construct(string $path, string $controller, string $method)
    {
        $this->path = trim($path, '/');
        $this->controller = $controller;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    public function matches(string $url): bool
    {
        $path = preg_replace('#:([\w]+)#', '([0-9]+)', $this->path);
        $pathToMatch = '/^\/' . str_replace('/', '\/', $path) . '$/';

        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $controller = new $this->controller(DBConnection::getInstance(DB_DNS, DB_USER, DB_PASSWORD));
        $method = $this->method;

        isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}