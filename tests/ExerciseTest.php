<?php


use App\Database\DBConnection;
use App\Models\Exercise;
use App\Models\ExercisesHelper;
use PHPUnit\Framework\TestCase;

require_once '../public/const.php';

class ExerciseTest extends TestCase
{
    protected ExercisesHelper $exercisesHelper;


    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        $dbConnection = DBConnection::getInstance(DB_DNS, DB_USER, DB_PASSWORD);
        self::$exercisesHelper = new ExercisesHelper($dbConnection);

        //create exercise for get all
        $exercise = new Exercise();
        $exercise->setTitle('Test Exercise 1');
        $exercise->setState('edit');
        self::$exercisesHelper->create($exercise);
    }


    /**
     * @param $exercisesHelper
     *
     * @return void
     *
     */
    public function test_exercise_can_be_created()
    {
        $title = 'Test Exercise';
        $exercise = new Exercise();
        $exercise->setTitle($title);
        $exercise->setState('edit');

        // verify that the exercise is the correct type
        $this->assertInstanceOf(ExercisesHelper::class, $this->exercisesHelper);

        //test of create exercise in database
        self::exercisesHelper->create($exercise);

        // verify that the exercise exists
        $this->assertEquals($title, $exercise->getTitle());
    }

    /**
     * @param $exercisesHelper
     *
     * @return void
     */
    public function test_get_one_exercise_by_title($exercisesHelper)
    {
        $exercise = $exercisesHelper->get_one_exercise_by_title('Test-Exercise');
        $this->assertEquals('Test-Exercise', $exercise->getTitle());
    }

    /**
     * @param $exercisesHelper
     *
     * @return void
     */
    public function test_get_all_exercises($exercisesHelper)
    {
        $exercises = $exercisesHelper->getAllExercises();
        $count = $exercises->count();
        $this->assertGreaterThan(1, $count);
    }

    /**
     * @param $exercisesHelper
     *
     * @return void
     */
    public function test_exercise_can_be_deleted($exercisesHelper)
    {
        $count = $exercisesHelper->getAllExercises();
        $exercise = $exercisesHelper->get_one_exercise_by_title('Test-Exercise');
        $exercise->delete();
        $exercise = $exercisesHelper->get_one_exercise_by_title('Test-Exercise 1');
        $exercise->delete();
        $countafterdelete = $exercisesHelper->getAllExercises();
        $this->assertEquals($count - 2, $countafterdelete);
    }

    /**
     * @param $exercisesHelper
     *
     * @return void
     */
    public function test_get_one_exercise_by_status($exercisesHelper)
    {
        $exercise = $exercisesHelper->get_one_exercise_by_status('edit');
        $this->assertEquals('edit', $exercise->getState());
    }

}