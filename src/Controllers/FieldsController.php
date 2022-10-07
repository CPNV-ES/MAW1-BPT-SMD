<?php

namespace App\Controllers;

use App\Database\DBConnection;
use App\Database\Query;
use App\Models\Exercise;
use App\Models\ExercisesHelper;

class FieldsController extends Controller
{
    protected Query $query;

    /**
     * @param DBConnection $db
     */
    public function __construct(DBConnection $db)
    {
        parent::__construct();
        $this->query = new Query($db, 'exercises', Exercise::class);
    }

    public function index(int $id)
    {
        $exercisesHelper = new ExercisesHelper($this->query);
        $exercise = $exercisesHelper->get([$id]);
        $this->view('fields/index');
    }
}