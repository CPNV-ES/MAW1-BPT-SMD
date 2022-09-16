<?php

namespace App\Controllers;

use App\models\Exercise;

class FieldsController extends Controller
{
    public function index(int $id)
    {
        $this->view('fields/index');
    }
}