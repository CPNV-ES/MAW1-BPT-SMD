<?php

namespace App\Controllers;

use App\Models\ExerciseHelper;
use App\Models\Field;

class FieldsController extends Controller
{
    protected ExerciseHelper $exerciseHelper;

    public function __construct()
    {
        parent::__construct();
        $this->exerciseHelper = new ExerciseHelper();
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function index(int $id): void
    {
        $exercise = $this->exerciseHelper->get([$id])[0];
        $params = [
            'exercise' => $exercise,
            'router'   => $this->router
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $field = new Field([
                'label'      => $_POST['field']['label'],
                'value_kind' => $_POST['field']['value_kind']
            ]);

            if ($exercise->createField($field)) {
                $this->router->redirect('fields_index', ['id' => $exercise->getId()]);
            } else {
                $params["error"] = "Le label déjà utilisé. Veuillez en choisir un autre.";
            }
        }

        $params['formAction'] = $this->router->generateUrl('fields_index', ['id' => $id]);

        $this->view('fields/index', $params);
    }

    public function edit(int $idExercise, int $idField): void
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];
        $field = $exercise->getFields([$idField])[0];
        $params = [
            'exercise' => $exercise,
            'field'    => $field,
            'router'   => $this->router
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $field->setLabel($_POST['field']['label']);
            $field->setValueKind($_POST['field']['value_kind']);

            if ($field->update()) {
                $this->router->redirect('fields_index', ['id' => $exercise->getId()]);
            } else {
                $params["error"] = "Le label déjà utilisé. Veuillez en choisir un autre.";
            }
        }

        $this->view('fields/edit', $params);
    }

    public function delete(int $idExercise, int $idField): void
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];
        $exercise->deleteField($idField);
        $this->router->redirect('fields_index', ['id' => $exercise->getId()]);
    }

    public function results(int $idExercise, int $field):void
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];

        $this->view('fields/results', [
            'exercise' => $exercise,
            'field'       => $exercise->getFields([$field])[0],
            'fulfillments' => $exercise->getFulfillments(),
            'router'       => $this->router
        ]);
    }
}