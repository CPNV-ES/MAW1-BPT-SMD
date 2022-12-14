<?php

namespace App\Controllers;

use App\Models\ExerciseHelper;
use App\Models\Fulfillment;

class FulfillmentController extends Controller
{
    protected ExerciseHelper $exerciseHelper;

    public function __construct()
    {
        parent::__construct();
        $this->exerciseHelper = new ExerciseHelper();
    }

    public function new(int $id): void
    {
        $exercise = $this->exerciseHelper->get([$id])[0];

        $this->view('fulfillments/new', [
            'router'   => $this->router,
            'exercise' => $exercise
        ]);
    }

    public function create(int $id): void
    {
        $answers_attributes = $_POST['fulfillment']['answers_attributes'];
        $answers = [];
        for ($i = 0; $i < count($answers_attributes); $i += 2) {
            $answers[$answers_attributes[$i]['field_id']] = $answers_attributes[$i + 1]['value'];
        }
        $exercise = $this->exerciseHelper->get([$id])[0];
        $fulfillment = new Fulfillment(['date' => (new \DateTime())->format('Y-m-d H:i:s'), 'exercise' => $exercise]);
        $fulfillment_id = $fulfillment->save($answers);

        $this->router->redirect('fulfillments_edit', ['id1' => $exercise->getId(), 'id2' => $fulfillment_id]);
    }

    public function edit(int $idExercise, int $idFulfillment)
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];
        $fulfillment = $exercise->getFulfillments($idFulfillment);

        $this->view('fulfillments/edit', [
            'router'      => $this->router,
            'exercise'    => $exercise,
            'fulfillment' => $fulfillment,
            'fields'      => $exercise->getFields()
        ]);
    }

    public function update(int $idExercise, int $idFulfillment)
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];
        $fulfillment = $exercise->getFulfillments($idFulfillment);

        $answers_attributes = $_POST['fulfillment']['answers_attributes'];
        $answers = [];
        for ($i = 0; $i < count($answers_attributes); $i += 2) {
            $answers[$answers_attributes[$i]['field_id']] = $answers_attributes[$i + 1]['value'];
        }
        $fulfillment->save($answers);

        $this->router->redirect('fulfillments_edit', ['id1' => $exercise->getId(), 'id2' => $fulfillment->getId()]);
    }

    public function results(int $idExercise, int $idFulfillment): void
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];

        $this->view('fulfillments/results', [
            'exercise'    => $exercise,
            'fields'      => $exercise->getFields(),
            'fulfillment' => $exercise->getFulfillments($idFulfillment),
            'router'      => $this->router
        ]);
    }
}
