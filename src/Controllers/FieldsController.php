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

    public function index(int $exerciseId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId);
        $params = [
            'exercise' => $exercise,
            'router'   => $this->router,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $field = new Field([
                'label'      => $_POST['field']['label'],
                'value_kind' => $_POST['field']['value_kind'],
            ]);

            if ($exercise->createField($field)) {
                $this->router->redirect('fields_index', ['exercise' => $exercise->getId()]);
            } else {
                $params["error"] = "Le label déjà utilisé. Veuillez en choisir un autre.";
            }
        }

        $this->view('fields/index', $params);
    }

    public function edit(int $exerciseId, int $fieldId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId);
        $field = $exercise->getFields($fieldId);
        $params = [
            'exercise' => $exercise,
            'field'    => $field,
            'router'   => $this->router,
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $field->setLabel($_POST['field']['label']);
            $field->setValueKind($_POST['field']['value_kind']);

            if ($field->update()) {
                $this->router->redirect('fields_index', ['exercise' => $exercise->getId()]);
            } else {
                $params["error"] = "Le label déjà utilisé. Veuillez en choisir un autre.";
            }
        }

        $this->view('fields/edit', $params);
    }

    public function delete(int $exerciseId, int $fieldId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId);
        $exercise->deleteField($fieldId);
        $this->router->redirect('fields_index', ['exercise' => $exercise->getId()]);
    }

    public function results(int $exerciseId, int $fieldId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId);

        $this->view('fields/results', [
            'exercise'     => $exercise,
            'field'        => $exercise->getFields($fieldId),
            'fulfillments' => $exercise->getFulfillments(),
            'router'       => $this->router,
        ]);
    }
}