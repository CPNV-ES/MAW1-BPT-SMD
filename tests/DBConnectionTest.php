<?php

use App\Database\DBConnection;
use App\Models\Exercise;
use PHPUnit\Framework\TestCase;

require_once '../public/const.php';

class DBConnectionTest extends TestCase
{

    protected static DBConnection $dbConnection;

    public static function setUpBeforeClass(): void
    {
        self::$dbConnection = DBConnection::getInstance(DB_DNS, DB_USER, DB_PASSWORD);
    }

    public function test_getInstance()
    {
        self::assertSame(self::$dbConnection, DBConnection::getInstance(DB_DNS, DB_USER, DB_PASSWORD));
    }

    public function test_getPDO()
    {
        self::assertSame(PDO::class, get_class(self::$dbConnection->getPDO()));
    }

    public function test_execute()
    {
        self::assertIsArray(self::$dbConnection->execute("SELECT * FROM exercises;", Exercise::class));
        self::assertIsBool(
            self::$dbConnection->execute("INSERT INTO exercises (title) VALUES (:title);", Exercise::class, [
                'title' => 'test DBConnection 1'
            ])
        );
        self::assertIsBool(
            self::$dbConnection->execute("UPDATE exercises SET title = :title1 WHERE title = :title2;", Exercise::class, [
                'title1' => 'test DBConnection 2',
                'title2' => 'test DBConnection 1'
            ])
        );
        self::assertIsBool(
            self::$dbConnection->execute("DELETE FROM exercises WHERE title = :title;", Exercise::class, [
                'title' => 'test DBConnection 2'
            ])
        );
    }

    public function test_getLastItemId()
    {
        self::assertIsInt(self::$dbConnection->getLastItemId());
    }
}
