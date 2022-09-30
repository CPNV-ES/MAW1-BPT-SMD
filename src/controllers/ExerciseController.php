<?php

namespace App\Controllers;

use App\Database\DBConnection;
use App\Database\Query;
use App\Models\Exercise;
use App\Models\ExerciseHelper;

class ExerciseController extends Controller
{
    protected Query $query;

    /**
     * @param DBConnection $db
     */
    function __construct (DBConnection $db)
    {
        parent::__construct();
        $this->query = new Query($db, 'exercises', Exercise::class);
    }

    /**
     * @return void
     */
    public function index (): void
    {
        $exercisesHelper = new ExerciseHelper($this->query);
        $exercises = $exercisesHelper->get();
        $this->view('exercises/index', compact('exercises'));
    }

    /**
     * @return void
     */
    public function create (): void
    {
        $this->view('exercises/new');
    }

    /**
     * @return void
     */
    public function createExercise (): void
    {
        $exercise = Exercise::withTitle($_POST['title']);

        $exercisesHelper = new ExerciseHelper($this->query);

        if ($exercisesHelper->create($exercise)) {
            header("Location: /exercises");
        } else {
            header("Location: /exercises/new");
        }
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete (int $id): void
    {
        $exercisesHelper = new ExerciseHelper($this->query);

        $exercisesHelper->delete($id);

        header('Location: /exercises');
    }
}