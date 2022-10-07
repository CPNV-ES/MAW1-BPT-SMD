<?php

namespace App\Database;

use PDO;

class DBConnection
{
    private static ?DBConnection $instance = null;

    protected string $dns;
    protected string $username;
    protected string $password;
    protected ?PDO   $pdo;

    /**
     * @param string $dns      Arguments required to create a database connection
     * @param string $username Username for connection
     * @param string $password Password for the connection
     */
    private function __construct(string $dns, string $username, string $password)
    {
        $this->dns = $dns;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param string $dns      Arguments required to create a database connection
     * @param string $username Username for connection
     * @param string $password Password for the connection
     *
     * @return DBConnection
     */
    public static function getInstance(string $dns, string $username, string $password): DBConnection
    {
        if (self::$instance == null) {
            self::$instance = new DBConnection($dns, $username, $password);
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
        $this->pdo = new PDO($this->dns, $this->username, $this->password);
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
     * @param bool|null  $single true for a single value in return
     *
     * @return bool|object|array
     */
    public function execute(string $sql, string $class, array $param = null, bool $single = null): bool|object|array
    {
        $method = is_null($param) ? 'query' : 'prepare';
        $stmt = $this->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class, [$this]);

        if (str_starts_with($sql, 'DELETE') || str_starts_with($sql, 'UPDATE') || str_starts_with($sql, 'INSERT')) {
            return $stmt->execute($param);
        }

        if ($method !== 'query') {
            $stmt->execute($param);
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';
        return $stmt->$fetch();
    }

    public function getLastItemId(): int
    {
        return $this->getPDO()->lastInsertId();
    }
}