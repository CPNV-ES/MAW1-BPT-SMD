<?php

namespace App\Controllers;

use App\Models\Exercise;

class FieldsController extends Controller
{
    public function index(int $id)
    {
        $this->render('fields/index');
    }
}