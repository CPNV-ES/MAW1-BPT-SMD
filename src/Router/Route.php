<?php

namespace App\Router;

use App\Database\DBConnection;

class Route
{
    protected string $path;
    protected string $action;
    protected array  $matches;

    /**
     * @param string $path   url path
     * @param string $action Controller::action
     */
    public function __construct(string $path, string $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
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
        $params = explode('::', $this->action);
        $controller = new $params[0]();
        $method = $params[1];

        isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}