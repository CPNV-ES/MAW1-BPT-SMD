<?php

namespace App\Controllers;

use App\Models\ExercisesHelper;

class FieldsController extends Controller
{
    public function index(int $id)
    {
        $exercisesHelper = new ExercisesHelper($this->dbConnection);
//        $exercise = $exercisesHelper->get([$id]);
        $this->view('fields/index');
    }
}