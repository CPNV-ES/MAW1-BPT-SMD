<?php

use App\Database\DBConnection;
use App\Database\Query;
use App\Models\Exercise;
use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__).'../public/const.php';

class QueryTest extends TestCase
{

    protected static Query $query;

    protected int $id;

    public static function setUpBeforeClass(): void
    {
        DBConnection::setUp(DB_DNS, DB_USER, DB_PASSWORD);
        self::$query = new Query();
    }

    protected function setUp(): void
    {
        $this->id = self::$query->insert(
            'exercises',
            Exercise::class,
            [
                'title' => 'Query Test',
                'state' => 'state'
            ]
        );
    }

    protected function tearDown(): void
    {
        self::$query->delete('exercises', Exercise::class, 'id = :id', ['id' => $this->id]);
    }

    public function test_insertIsInt()
    {
        //given
        //refer to setUp method

        //when
        //event is called directly by the assertion

        //then
        self::assertIsInt($this->id);
    }

    public function test_insertException()
    {
        //given
        //refer to setUp method

        //when
        $this->expectException(PDOException::class);
        self::$query->insert('exercises', Exercise::class, ['title' => 'Query Test']);

        //then
        //throw pdo exception
    }

    public function test_select_all()
    {
        //given
        //refer to setUp

        //when
        //event is called directly by the assertion

        //then
        self::assertIsArray(self::$query->select('exercises', Exercise::class));
    }

    public function test_select_id()
    {
        //given
        //refer to setUp

        //when
        $exercises = self::$query->select('exercises', Exercise::class, 'id = :id', ['id' => $this->id]);

        //then
        self::assertIsArray($exercises);
    }

    public function test_update()
    {
        //given
        //refer to setUp

        //when
        //event is called directly by the assertion

        //then
        self::assertTrue(
            self::$query->update(
                'exercises',
                Exercise::class,
                'id = :id', ['id' => $this->id],
                ['title' => 'test update']
            )
        );
    }

    public function test_delete()
    {
        //given
        $id = self::$query->insert(
            'exercises',
            Exercise::class,
            [
                'title' => 'test delete',
                'state' => 'state'
            ]
        );

        //when
        //event is called directly by the assertion

        //then
        self::assertTrue(self::$query->delete('exercises', Exercise::class, 'id = :id', ['id' => $id]));
    }
}
