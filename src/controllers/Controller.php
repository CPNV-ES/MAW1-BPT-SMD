<?php

namespace App\Controllers;

use App\Database\DBConnection;

abstract class Controller
{
    protected DBConnection $db;

    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
    }

    protected function view(string $path, array $params = null)
    {
        ob_start();
        require TEMPLATES_DIR . $path . '.php';
        $content = ob_get_clean();
        require TEMPLATES_DIR . 'layout.php';
    }

    protected function getDB()
    {
        return $this->db;
    }
}