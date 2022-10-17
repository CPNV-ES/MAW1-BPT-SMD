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
    public function new(): void
    {
        $params = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercise = new Exercise(['title' => $_POST['title']]);
            $exercisesHelper = new ExercisesHelper($this->dbConnection);
            if ($id = $exercisesHelper->create($exercise)) {
                $this->router->redirect('fields_index', ['id' => $id]);
            } else {
                $params["error"] = "Le titre est déjà utilisé. Veuillez en choisir un autre.";
            }
        }
        $this->view('exercises/new', $params);
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

        $this->router->redirect('exercises_index');
    }
}