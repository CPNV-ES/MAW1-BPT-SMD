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

    public static function setUp(string $dns, string $user, string $password): void
    {
        self::$dns = $dns;
        self::$user = $user;
        self::$password = $password;
    }

    /**
     * @return DBConnection
     */
    public static function getInstance(): DBConnection
    {
        if (self::$instance == null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    /**
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
     * @return void
     */
    protected function open(): void
    {
        $this->pdo = new PDO(self::$dns, self::$user, self::$password);
    }

    /**
     * Close dbConnection connection
     *
     * @return void
     */
    protected function close(): void
    {
        $this->pdo = null;
    }

    /**
     * Run a query on the database
     *
     * @param string     $sql    Sql to run
     * @param string     $class  class expected in return
     * @param array|null $param  params for the query
     * @param bool       $single true for a single value in return
     *
     * @return bool|object|array
     */
    public function execute(string $sql, string $class, array $param = null, bool $single = false): bool|object|array
    {
        $method = is_null($param) ? 'query' : 'prepare';
        $stmt = $this->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);

        if (str_starts_with($sql, 'DELETE') || str_starts_with($sql, 'UPDATE') || str_starts_with($sql, 'INSERT')) {
            return $stmt->execute($param);
        }

        if ($method !== 'query') {
            $stmt->execute($param);
        }

        $fetch = $single ? 'fetch' : 'fetchAll';
        return $stmt->$fetch();
    }

    /**
     * @return int
     */
    public function getLastItemId(): int
    {
        return $this->getPDO()->lastInsertId();
    }
}