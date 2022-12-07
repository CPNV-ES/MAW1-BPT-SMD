<?php

namespace App\Controllers;

use App\Models\ExerciseHelper;
use App\Models\Field;
use App\Models\FieldsHasFulfillments;

class FieldsController extends Controller
{
    protected ExerciseHelper $exerciseHelper;
    protected FieldsHasFulfillments $fieldsHasFulfillments;

    public function __construct()
    {
        parent::__construct();
        $this->exerciseHelper = new ExerciseHelper();
        $this->fieldsHasFulfillments = new FieldsHasFulfillments();
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

    public function results(int $exercise, int $field):void
    {
        $field = ['id'=>$field];
        // get the answer for that field
        $field_has_fulfillments = $this->fieldsHasFulfillments->get($field);

        $exercise = $this->exerciseHelper->get([$exercise])[0];

        //give the fulfillments their id to get them
        foreach ($field_has_fulfillments as $element){
            $fulfillments[] = $exercise->getFulfillments($element->fulfillments_id);
        }
        $this->view('fields/results', [
            'field'       => $exercise->getFields($field),
            'fulfillments' => $fulfillments,
            'router'       => $this->router
        ]);
    }
}