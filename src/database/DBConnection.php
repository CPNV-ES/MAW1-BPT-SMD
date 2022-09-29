<?php

namespace App\Database;

use PDO;

class DBConnection
{
    protected string $dbname;
    protected string $host;
    protected string $charset;
    protected string $username;
    protected string $password;
    protected ?PDO   $pdo;

    /**
     * @param string $dbname   Name of the database
     * @param string $host     Url to join the database
     * @param string $charset  Charset of the base
     * @param string $username Username for connection
     * @param string $password Password for the connection
     */
    public function __construct (string $dbname, string $host, string $charset, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->charset = $charset;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPDO (): PDO
    {
        if (!isset($this->pdo)) $this->open();
        return $this->pdo;
    }

    /**
     * @return void
     */
    protected function open (): void
    {
        $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host};charset{$this->charset}", $this->username, $this->password,);
    }

    /**
     * Close db connection
     *
     * @return void
     */
    protected function close (): void
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
    public function execute (string $sql, string $class, array $param = null, bool $single = null): bool|object|array
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
}