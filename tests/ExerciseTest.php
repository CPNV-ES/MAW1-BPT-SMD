<?php


use App\Database\DBConnection;
use App\Models\Exercise;
use App\Models\ExercisesHelper;
use PHPUnit\Framework\TestCase;

require_once '../public/const.php';

class ExerciseTest extends TestCase
{
    protected static ExercisesHelper $exercisesHelper;


    public static function setUpBeforeClass(): void
    {
        $dbConnection = DBConnection::getInstance(DB_DNS, DB_USER, DB_PASSWORD);
        self::$exercisesHelper = new ExercisesHelper($dbConnection);
    }


    public function test_exercise_can_be_created($exercisesHelper)
    {
        $title = 'Test Exercise';
        $exercise = new Exercise();
        $exercise->setTitle($title);

        // verify that the exercise is the correct type
        $this->assertInstanceOf(ExercisesHelper::class, $exercisesHelper);

        //test of create exercise in database
        $exercisesHelper->create($exercise);

        // verify that the exercise exists
        $this->assertEquals($title, $exercise->getTitle());
    }

    public function test_get_one_exercise_by_title()
    {
        $exercise = $exercisesHelper->get_one_exercise_by_title('Test-Exercise');
        $this->assertEquals('Test-Exercise', $exercise->getTitle());
    }

    public function test_get_all_exercises()
    {
        $exercises = $exercisesHelper->getAllExercises();
        $count = $exercises->count();
        $this->assertGreaterThan(1, $count);
    }

    public function test_exercise_can_be_deleted()
    {
        $exercise = $exercisesHelper->get_one_exercise_by_title('Test-Exercise');
        $exercise->delete();
    }

    public function test_get_one_exercise_by_status()
    {
        $exercise = $exercisesHelper->get_one_exercise_by_status('edit');
        $this->assertEquals('edit', $exercise->getState());
    }

}