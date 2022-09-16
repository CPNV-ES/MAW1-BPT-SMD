<?php

namespace App\Controllers;

use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercise = new Exercise($this->getDB());
        $exercises = $exercise->all();
        $this->view('exercises/index', [compact('exercises')]);
    }

    public function create()
    {
        $this->view('exercises/new');
    }

    public function createExercise()
    {
        $exercise = new Exercise($this->getDB());

        $result = $exercise->create([
            'title' => $_POST['title']
        ]);

        if ($result) {
            return header("Location: /exercises/{$result}/fields");
        }
    }

    public function delete(int $id)
    {
        $exercise = new Exercise($this->getDB());

        $result = $exercise->destroy($id);

        if ($result) {
            return header('Location: /exercises');
        }
    }
}