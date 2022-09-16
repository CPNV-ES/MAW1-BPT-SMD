<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $isHome = true;
        $this->view('site/index', [compact('isHome')]);
    }
}