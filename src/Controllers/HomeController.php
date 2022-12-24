<?php

namespace App\Controllers;

use App\Router\Router;

class HomeController extends Controller
{
    public function index()
    {
        $isHome = true;
        $router = Router::getInstance();
        $this->view('site/index', compact('isHome', 'router'));
    }
}