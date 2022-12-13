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

    public function new(int $exerciseId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId);

        $this->view('fulfillments/new', [
            'router'   => $this->router,
            'exercise' => $exercise
        ]);
    }

    public function create(int $exerciseId): void
    {
        $answers_attributes = $_POST['fulfillment']['answers_attributes'];
        $answers = [];
        for ($i = 0; $i < count($answers_attributes); $i += 2) {
            $answers[$answers_attributes[$i]['field_id']] = $answers_attributes[$i + 1]['value'];
        }
        $exercise = $this->exerciseHelper->get($exerciseId);
        $fulfillment = new Fulfillment(['date' => (new \DateTime())->format('Y-m-d H:i:s'), 'exercise' => $exercise]);
        $fulfillment_id = $fulfillment->save($answers);

        $this->router->redirect('fulfillments_edit', ['exercise' => $exercise->getId(), 'fulfillment' => $fulfillment_id]);
    }

    public function edit(int $exerciseId, int $fulfillmentId)
    {
        $exercise = $this->exerciseHelper->get($exerciseId);
        $fulfillment = $exercise->getFulfillment($fulfillmentId);

        $this->view('fulfillments/edit', [
            'router'      => $this->router,
            'exercise'    => $exercise,
            'fulfillment' => $fulfillment,
            'fields'      => $exercise->getFields()
        ]);
    }

    public function update(int $exerciseId, int $fulfillmentId)
    {
        $exercise = $this->exerciseHelper->get($exerciseId);
        $fulfillment = $exercise->getFulfillment($fulfillmentId);

        $answers_attributes = $_POST['fulfillment']['answers_attributes'];
        $answers = [];
        for ($i = 0; $i < count($answers_attributes); $i += 2) {
            $answers[$answers_attributes[$i]['field_id']] = $answers_attributes[$i + 1]['value'];
        }
        $fulfillment->save($answers);

        $this->router->redirect('fulfillments_edit', ['exercise' => $exercise->getId(), 'fulfillment' => $fulfillment->getId()]);
    }
}
