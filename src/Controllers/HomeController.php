<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $isHome = true;
        $this->render('site/index', compact('isHome'));
    }
}