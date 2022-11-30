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

    /**
     * @param int $id
     *
     * @return void
     */
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
        $exercise = $this->exerciseHelper->get([$id])[0];

        $fulfillment = new Fulfillment(new \DateTime(), $exercise);
        $fulfillment->save();
    }
}
