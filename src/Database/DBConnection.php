<?php

namespace App\Database;

use PDO;

class DBConnection
{
    private static ?DBConnection $instance = null;

    protected static string $dns;
    protected static string $user;
    protected static string $password;
    protected ?PDO          $pdo;

    /**
     * Method to set the database connection details
     *
     * @param string $dns Data source name (DSN) for the database connection
     * @param string $user Username for the database connection
     * @param string $password Password for the database connection
     *
     * @return void
     */
    public static function setUp(string $dns, string $user, string $password): void
    {
        self::$dns = $dns;
        self::$user = $user;
        self::$password = $password;
    }

    /**
     * Method to get the single instance of the class
     *
     * @return DBConnection
     */
    public static function getInstance(): DBConnection
    {
        return self::$instance ??= new DBConnection();
    }

    /**
     * Method to get the PDO object for the database connection
     *
     * @return PDO
     */
    public function getPDO(): PDO
    {
        if (!isset($this->pdo)) {
            $this->open();
        }
        return $this->pdo;
    }

    /**
     * Method to open a new database connection
     *
     * @return void
     */
    protected function open(): void
    {
        $this->pdo = new PDO(self::$dns, self::$user, self::$password);
    }

    /**
     * Method to close the database connection
     *
     * @return void
     */
    protected function close(): void
    {
        $this->pdo = null;
    }

    /**
     * Method to execute a database query
     *
     * @param string     $sql SQL statement to execute
     * @param string     $class Name of the class to use for the result objects
     * @param array|null $param Optional parameters for the query
     * @param bool       $single Optional flag indicating whether to return a single object or an array of objects
     *
     * @return object|bool|array
     */
    public function execute(string $sql, string $class, array $param = null, bool $single = false): object|bool|array
    {
        $request = $this->getPDO()->prepare($sql);

        $request->execute($param);

        if (str_starts_with($sql, 'SELECT')) {
            if ($single) {
                return $request->fetchObject($class);
            } else {
                return $request->fetchAll(PDO::FETCH_CLASS, $class);
            }
        } else {
            return $request->rowCount() > 0;
        }
    }

    /**
     * Method to get the ID of the last inserted item
     *
     * @return int
     */
    public function getLastItemId(): int
    {
        return $this->getPDO()->lastInsertId();
    }
}