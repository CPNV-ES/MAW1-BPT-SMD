<?php

use PHPUnit\Framework\TestCase;
use App\Models\Exercise;
use App\Models\exercisesHelper;

class ExerciseTest extends TestCase
{
    protected static Exercise $exercise;
    protected static ExercisesHelper      $exercisesHelper;

    public function test_constructor_NOT_THE_WRIGHT_ONE_WE_MUST_CHANGE_IT_TO_THE_CORRECT_ONE()
    {
        $title = 'Test-Exercise';
        $exercise = new Exercise();
        $exercise->setTitle($title);
        $exercise->setState('edit');
        $this->assertEquals($title,$exercise->getTitle());
    }

    public function test_get_id()
    {

        $exercise = new Exercise();
        $exercise->setTitle('Test-ExerciseId');
        $exercise->setState('edit');
        $createdExercise = self::$exercisesHelper->create($exercise);

        $this->assertEquals($createdExercise->id,$exercise->getId());
    }
    public function test_get_title ()
    {
        $title = 'Test-ExerciseTitle';
        $exercise = new Exercise();
        $exercise->setTitle($title);
        $this->assertEquals($title,$exercise->getTitle());
    }
    public function test_get_state ()
    {
        $state = 'edit';
        $exercise = new Exercise();
        $exercise->setState($state);
        $this->assertEquals($state,$exercise->getState());
    }
    public function test_set_title ()
    {
        $title = 'Test-ExerciseTitle';
        $exercise = new Exercise();
        $exercise->setTitle('not-the-true-title');
        $this->assertNotEquals($title,$exercise->getTitle());
        $exercise->setTitle($title);
        $this->assertEquals($title,$exercise->getTitle());
    }
    public function test_set_state ()
    {
        $state = 'edit';
        $exercise = new Exercise();
        $exercise->setState('not-the-true-state');
        $this->assertNotEquals($state,$exercise->getState());
        $exercise->setState($state);
    }


}