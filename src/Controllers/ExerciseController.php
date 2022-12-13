<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseHelper;

class ExerciseController extends Controller
{
    protected ExerciseHelper $exerciseHelper;

    public function __construct()
    {
        parent::__construct();
        $this->exerciseHelper = new ExerciseHelper();
    }

    public function index(): void
    {
        $this->view('exercises/index', [
            'exercises' => $this->exerciseHelper->get(),
            'router'    => $this->router
        ]);
    }

    public function new(): void
    {
        $params['router'] = $this->router;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercise = new Exercise(['title' => $_POST['title']]);
            if ($exerciseId = $this->exerciseHelper->save($exercise)) {
                $this->router->redirect('fields_index', ['exercise' => $exerciseId]);
            }
            $params["error"] = "Le titre est déjà utilisé. Veuillez en choisir un autre.";
        }
        $this->view('exercises/new', $params);
    }

    public function state(int $exerciseId, string $query)
    {
        parse_str($query, $params);

        $exercise = $this->exerciseHelper->get([$exerciseId])[0];
        $exercise->setState($params['state']);

        $this->exerciseHelper->save($exercise);

        $this->router->redirect('exercises_index');
    }

    public function answering(): void
    {
        $this->view('exercises/answering', [
            'exercises' => $this->exerciseHelper->get(),
            'router'    => $this->router
        ]);
    }

    public function delete(int $exerciseId): void
    {
        $this->exerciseHelper->delete($exerciseId);
        $this->router->redirect('exercises_index');
    }
}