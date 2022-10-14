<?php

namespace App\Controllers;

use App\Database\DBConnection;

abstract class Controller
{
    protected DBConnection $dbConnection;

    public function __construct(DBConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param string     $path
     * @param array|null $params
     *
     * @return void
     */
    protected function view(string $path, array $params = null): void
    {
        ob_start();
        require TEMPLATES_DIR . $path . '.php';
        $content = ob_get_clean();
        require TEMPLATES_DIR . 'layout.php';
    }

}