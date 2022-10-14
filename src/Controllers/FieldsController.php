<?php

namespace App\Controllers;

use App\Models\ExercisesHelper;

class FieldsController extends Controller
{
    public function index(int $id)
    {
        $exercisesHelper = new ExercisesHelper();
        $exercise = $exercisesHelper->get([$id])[0];
        $this->view('fields/index', compact('exercise'));
    }
}