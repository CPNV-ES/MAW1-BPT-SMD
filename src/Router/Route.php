<?php

namespace App\Router;

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
        $url_components = parse_url($url);
        $path = preg_replace('#:([\w]+)#', '([0-9]+)', $this->path);
        $pathToMatch = '/^\/' . str_replace('/', '\/', $path) . '$/';

        if (preg_match($pathToMatch, $url_components['path'], $matches)) {
            $this->matches = $matches;
            if (isset($url_components['query'])) {
                $this->matches[] = $url_components['query'];
            }
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
        $controller = new $this->controller();
        $method = $this->method;

        if (isset($this->matches[2])) {
            $controller->$method($this->matches[1], $this->matches[2]);
        } elseif (isset($this->matches[1])) {
            $controller->$method($this->matches[1]);
        } else {
            $controller->$method();
        }
    }
}