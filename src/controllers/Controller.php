<?php

namespace App\Controllers;


abstract class Controller
{

    public function __construct ()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    /**
     * @param string     $path
     * @param array|null $params
     *
     * @return void
     */
    protected function view (string $path, array $params = null): void
    {
        ob_start();
        require TEMPLATES_DIR . $path . '.php';
        $content = ob_get_clean();
        require TEMPLATES_DIR . 'layout.php';
    }

}