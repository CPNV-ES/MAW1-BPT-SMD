<?php

namespace App\Controllers;

use App\Models\ExerciseHelper;

class FieldsController extends Controller
{
    public function index(int $id)
    {
        $ExerciseHelper = new ExerciseHelper($this->dbConnection);
//        $exercise = $ExerciseHelper->get([$id]);
        $this->view('fields/index');
    }
}