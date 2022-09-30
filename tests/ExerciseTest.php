<?php

use App\models\Exercise;
use PHPUnit\Framework\TestCase;

class ExerciseTest extends TestCase
{

    public function test_exercise_can_be_created ()
    {
        $title = 'Test Exercise';
        $exercise = new Exercise($title, 'edit');
        // verify that the exercise is the correct type
        $this->assertInstanceOf(Exercise::class, $exercise);
        $this->assertEquals($title, $exercise->getTitle());
        //test of create exercise in database
        $exercise->create();
    }

    public function test_get_one_exercise_by_title ()
    {
        $exercise = get_one_exercise_by_title('Test-Exercise');
        $this->assertEquals('Test-Exercise', $exercise->getTitle());
    }

    public function test_get_all_exercises ()
    {

        $exercises = $this->getAllExercises();
        $count = $this->count();
        $this->assertGreaterThan(1, $count);


    }

    public function test_exercise_can_be_deleted ()
    {
        $exercise = get_one_exercise_by_title('Test-Exercise');
        $exercise->delete();
    }

    public function test_get_one_exercise_by_status ()
    {
        $exercise = get_one_exercise_by_status('edit');
        $this->assertEquals('edit', $exercise->getState());
    }

    private function create_exercises_for_testing ()
    {
        $exercise = new Exercise('Test-Exercise', 'edit');
        $newExercise["id"][] = $exercise->create();
    }
}