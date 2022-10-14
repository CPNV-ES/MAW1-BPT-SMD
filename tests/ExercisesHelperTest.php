<?php


use App\Database\DBConnection;
use App\Models\Exercise;
use App\Models\ExercisesHelper;
use PHPUnit\Framework\TestCase;

require_once '../public/const.php';

class ExercisesHelperTest extends TestCase
{

    protected static ExercisesHelper      $exercisesHelper;

    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        $dbConnection = DBConnection::getInstance(DB_DNS, DB_USER, DB_PASSWORD);
        self::$exercisesHelper = new ExercisesHelper($dbConnection);

        //create exercise for get all
        $exercise = new Exercise();
        $exercise->setTitle('Test-Exercise');
        $exercise->setState('edit');
        self::$exercisesHelper->create($exercise);
    }
    
    /**
     *
     * @return void
     *
     */
    public function test_exercise_can_be_created()
    {
        $title = 'Test-Exercise 1';
        $exercise = new Exercise();
        $exercise->setTitle($title);
        $exercise->setState('edit');

        // verify that the exercise is the correct type
        $this->assertInstanceOf(ExercisesHelper::class, self::$exercisesHelper);

        //test of create exercise in database
        self::$exercisesHelper->create($exercise);

        // verify that the exercise exists
        $this->assertEquals($title, $exercise->getTitle());
    }

    /**
     *
     * @return void
     */
    public function test_get_one_exercise_by_title()
    {
        $exercise = self::$exercisesHelper->getOneByTitle('Test-Exercise');
        $this->assertEquals('Test-Exercise', $exercise->getTitle());
    }

    /**
     * @param $exercisesHelper
     *
     * @return void
     */
    public function test_get_all_exercises()
    {
        $exercises = self::$exercisesHelper->getAllExercises();
        $count = $exercises->count();
        $this->assertGreaterThan(1, $count);
    }

    /**
     * @param $exercisesHelper
     *
     * @return void
     */
    public function test_exercise_can_be_deleted()
    {
        $count = self::$exercisesHelper->get();

        $exercise = self::$exercisesHelper->getOneByTitle('Test-Exercise');
        self::$exercisesHelper->delete($exercise->getId());
        $exercise = self::$exercisesHelper->getOneByTitle('Test-Exercise 1');
        self::$exercisesHelper->delete($exercise->getId());

        $countafterdelete = self::$exercisesHelper->get();
        $this->assertEquals($count - 2, $countafterdelete);
    }




}