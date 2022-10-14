<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\ExercisesHelper;

class ExerciseController extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        $exercisesHelper = new ExercisesHelper($this->dbConnection);
        $exercises = $exercisesHelper->get();
        $this->view('exercises/index', compact('exercises'));
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->view('exercises/new');
    }

    /**
     * @return void
     */
    public function createExercise(): void
    {
        $exercise = new Exercise(['title' => $_POST['title']]);

        $exercisesHelper = new ExercisesHelper($this->dbConnection);

        if ($id = $exercisesHelper->create($exercise)) {
            header("Location: /exercises/{$id}/fields");
        } else {
            $params['error'] = "Le titre est déjà utilisé. Veuillez en choisir un autre.";
            header("Location: /exercises/new");
        }
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $exercisesHelper = new ExercisesHelper($this->dbConnection);

        $exercisesHelper->delete($id);

        header('Location: /exercises');
    }
}