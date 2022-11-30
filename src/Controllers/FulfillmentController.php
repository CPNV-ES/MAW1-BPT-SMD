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
     * @return void
     */
    public function choose(): void
    {
        $this->view('fulfillments/choose', [
            'exercises' => $this->exerciseHelper->get(),
            'router'    => $this->router
        ]);
    }
}