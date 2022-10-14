<?php


use App\Database\DBConnection;
use App\Models\Exercise;
use App\Models\ExercisesHelper;
use PHPUnit\Framework\TestCase;

require_once '../public/const.php';

class ExercisesHelperTest extends TestCase
{

    protected static ExercisesHelper $exercisesHelper;
    protected static int             $id;

    /**
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        DBConnection::setUp(DB_DNS, DB_USER, DB_PASSWORD);
        self::$exercisesHelper = new ExercisesHelper();

        //create exercise for get all
        $exercise = new Exercise();
        $exercise->setTitle('Test-ExercisesHelper');
        $exercise->setState('edit');
        self::$id = self::$exercisesHelper->create($exercise);
    }

    /**
     * @return void
     */
    public function test_exercise_can_be_created()
    {
        $title = 'Test-ExercisesHelper 1';
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
     * @return void
     */
    public function test_get_one_exercise_by_title()
    {
        $exercise = self::$exercisesHelper->getOneByTitle('Test-Exercise');
        $this->assertEquals('Test-ExercisesHelper', $exercise->getTitle());
    }

    /**
     * @return void
     */
    public function test_get_all_exercises()
    {
        $exercises = self::$exercisesHelper->get();
        $count = count($exercises);
        $this->assertGreaterThan(1, $count);
    }

    /**
     * @return void
     */
    public function test_exercise_can_be_deleted()
    {
        $count = count(self::$exercisesHelper->get());
        $exercises = self::$exercisesHelper->get([self::$id]);
        self::$exercisesHelper->delete($exercises[0]->getId());

        $countAfterDelete = count(self::$exercisesHelper->get());
        $this->assertEquals($count - 1, $countAfterDelete);
    }

}