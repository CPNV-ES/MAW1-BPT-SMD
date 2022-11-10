<?php

use App\Database\DBConnection;
use App\Models\Exercise;
use App\Models\ExerciseHelper;
use PHPUnit\Framework\TestCase;

require_once '../public/const.php';

class ExerciseHelperTest extends TestCase
{

    protected static ExerciseHelper $ExerciseHelper;
    protected array                 $id;
    protected const                TITLE = 'Test-ExerciseHelper';

    public static function setUpBeforeClass(): void
    {
        DBConnection::setUp(DB_DNS, DB_USER, DB_PASSWORD);
        self::$ExerciseHelper = new ExerciseHelper();
    }

    protected function setUp(): void
    {
        $exercise = new Exercise(['title' => self::TITLE]);
        $this->id[] = self::$ExerciseHelper->create($exercise);
    }

    protected function tearDown(): void
    {
        foreach ($this->id as $id) {
            self::$ExerciseHelper->delete($id);
        }
    }

    public function test_create_exercise()
    {
        //given
        //refer to setUp method

        //when
        //event is called directly by the assertion

        //then
        $exercise = self::$ExerciseHelper->get([$this->id[0]])[0];
        self::assertEquals($this->id[0], $exercise->getId());
    }

    public function test_create_same_title()
    {
        //given
        //refer to setUp method

        //when
        //event is called directly by the assertion
        $exercise = new Exercise(['title' => self::TITLE]);

        //then
        $this->assertFalse(!!self::$ExerciseHelper->create($exercise));
    }

    public function test_create_null_title()
    {
        //given
        //refer to setUp method

        //when
        //event is called directly by the assertion

        //then
        $exercise = new Exercise();
        $this->expectException(Error::class);
        self::$ExerciseHelper->create($exercise);
    }

    public function test_exercise_get_by_id()
    {
        //given
        //refer to setUp method

        //when
        //event is called directly by the assertion

        //then
        $exercise = self::$ExerciseHelper->get([$this->id[0]])[0];
        $this->assertEquals(self::TITLE, $exercise->getTitle());
    }

    public function test_exercise_get_all()
    {
        //given
        //refer to setUp method

        //when
        $count = count(self::$ExerciseHelper->get());
        $this->id[] = self::$ExerciseHelper->create(new Exercise(['title' => 'Test-ExerciseHelper2']));

        //then
        $this->assertCount($count + 1, self::$ExerciseHelper->get());
    }

    public function test_exercise_can_be_deleted()
    {
        //given
        //refer to setUp method

        //when
        //event is called directly by the assertion

        //then
        $count = count(self::$ExerciseHelper->get());
        self::$ExerciseHelper->delete($this->id[0]);

        $this->assertCount($count - 1, self::$ExerciseHelper->get());
    }

}