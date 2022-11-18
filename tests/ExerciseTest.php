<?php

use App\Database\DBConnection;
use PHPUnit\Framework\TestCase;
use App\Models\Exercise;
use App\Models\ExerciseHelper;

require_once '../public/const.php';

class ExerciseTest extends TestCase
{
    protected static Exercise       $exercise;
    protected static ExerciseHelper $exerciseHelper;

    public static function setUpBeforeClass(): void
    {
        DBConnection::setUp(DB_DNS, DB_USER, DB_PASSWORD);
    }

    public function test_constructor()
    {
        $title = 'Test-Exercise';
        $exercise = new Exercise(['title' => $title]);
        $this->assertEquals($title, $exercise->getTitle());
    }

    public function test_get_id()
    {
        $exerciseHelper = new ExerciseHelper();
        $exercise = new Exercise();
        $exercise->setTitle('Test-ExerciseId');
        $exercise->setState('edit');
        $id = $exerciseHelper->save($exercise);

        $exercise = $exerciseHelper->get([$id])[0];

        $this->assertEquals($id, $exercise->getId());

        $exerciseHelper->delete($id);
    }

    public function test_get_title()
    {
        $title = 'Test-ExerciseTitle';
        $exercise = new Exercise();
        $exercise->setTitle($title);
        $this->assertEquals($title, $exercise->getTitle());
    }

    public function test_get_state()
    {
        $state = 'edit';
        $exercise = new Exercise();
        $exercise->setState($state);
        $this->assertEquals($state, $exercise->getState());
    }

    public function test_set_title()
    {
        $title = 'Test-ExerciseTitle';
        $exercise = new Exercise();
        $exercise->setTitle('not-the-true-title');
        $this->assertNotEquals($title, $exercise->getTitle());
        $exercise->setTitle($title);
        $this->assertEquals($title, $exercise->getTitle());
    }

    public function test_set_state()
    {
        $state = 'edit';
        $exercise = new Exercise();
        $exercise->setState('not-the-true-state');
        $this->assertNotEquals($state, $exercise->getState());
        $exercise->setState($state);
    }


}