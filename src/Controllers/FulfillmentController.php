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

        $this->view('fulfillements/new', [
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
        $fulfillment = new Fulfillment(new \DateTime(), $exercise);
        $fulfillment_id = $fulfillment->save($answers);
    }

    public function edit(int $idExercise, int $idFulfillment)
    {
        $exercise = $this->exerciseHelper->get([$idExercise])[0];
        $fulfillment = Fulfillment::get($idFulfillment);
    }
}
