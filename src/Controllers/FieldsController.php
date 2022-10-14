<?php

namespace App\Controllers;

use App\Models\ExercisesHelper;
use App\Models\Field;

class FieldsController extends Controller
{
    public function index(int $id)
    {
        $exercise = (new ExercisesHelper())->get([$id])[0];

        $params = compact('exercise');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $field = new Field([
                'label' => $_POST["field"]['label'],
                'value' => $_POST["field"]["value_kind"]
            ]);

            if ($exercise->createField($field)) {
                header("Location: /exercises/{$exercise->getId()}/fields");
            } else {
                $params["error"] = "Le nom du label est déjà utilisé. Veuillez en choisir un autre.";
            }
        }

        $this->view('fields/index', $params);
    }

    public function delete(int $idExercise, int $idField)
    {
        $exercise = (new ExercisesHelper())->get([$idExercise])[0];

        $exercise->deleteField($idField);

        header("Location: /exercises/{$exercise->getId()}/fields");
    }
}