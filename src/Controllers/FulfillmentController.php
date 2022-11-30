<?php

namespace App\Controllers;

use App\Models\ExerciseHelper;

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            die();
        }

        $params['router'] = $this->router;
        $params['exercise'] = $exercise;
        $this->view('fulfillements/new', $params);
    }
}