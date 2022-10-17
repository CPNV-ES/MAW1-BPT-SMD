<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\ExercisesHelper;

class ExerciseController extends Controller
{
    protected ExercisesHelper $exercisesHelper;

    public function __construct()
    {
        parent::__construct();
        $this->exercisesHelper = new ExercisesHelper();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $this->view('exercises/index', [
            'exercises' => $this->exercisesHelper->get(),
            'router'    => $this->router
        ]);
    }

    /**
     * @return void
     */
    public function new(): void
    {
        $params['router'] = $this->router;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercise = new Exercise(['title' => $_POST['title']]);

            if ($id = $this->exercisesHelper->create($exercise)) {
                $this->router->redirect('fields_index', ['id' => $id]);
            }

            $params["error"] = "Le titre est déjà utilisé. Veuillez en choisir un autre.";
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
        $this->exercisesHelper->delete($id);

        $this->router->redirect('exercises_index');
    }
}