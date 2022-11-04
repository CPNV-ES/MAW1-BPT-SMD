<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseHelper;

class ExerciseController extends Controller
{
    /**
     * @return void
     */
    public function index(): void
    {
        $ExerciseHelper = new ExerciseHelper($this->dbConnection);
        $exercises = $ExerciseHelper->get();
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
            $ExerciseHelper = new ExerciseHelper($this->dbConnection);
            if ($exercise->getTitle() !== "" && ($id = $ExerciseHelper->create($exercise))) {
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
        if ($_POST) {
            $ExerciseHelper = new ExerciseHelper($this->dbConnection);

            $ExerciseHelper->delete($id);

            $this->router->redirect('exercises_index');
        }
    }
}