<?php

namespace App\Router;

use App\Database\DBConnection;

class Route
{
    public $path;
    public $action;
    public $matches;

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matches(string $url)
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

    public function execute()
    {
        $params = explode('::', $this->action);
        $controller = new $params[0](new DBConnection(DB_NAME, DB_HOST, DB_CHARSET, DB_USER, DB_PASSWORD));
        $method = $params[1];

        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
}