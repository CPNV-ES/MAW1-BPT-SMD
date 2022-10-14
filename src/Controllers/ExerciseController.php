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
        $exercisesHelper = new ExercisesHelper();
        $exercises = $exercisesHelper->get();
        $this->view('exercises/index', compact('exercises'));
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $params = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercise = new Exercise(['title' => $_POST['title']]);
            $exercisesHelper = new ExercisesHelper();
            if ($id = $exercisesHelper->create($exercise)) {
                header("Location: /exercises/{$id}/fields");
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
        $exercisesHelper = new ExercisesHelper();

        $exercisesHelper->delete($id);

        header('Location: /exercises');
    }
}