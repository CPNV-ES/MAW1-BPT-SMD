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
    protected ?PDO $pdo;

    public function __construct(string $dbname, string $host, string $charset, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->charset = $charset;
        $this->username = $username;
        $this->password = $password;
    }

    public function open(): PDO
    {
        return $this->pdo ?? $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host};charset{$this->charset}", $this->username, $this->password,);
    }

    public function close()
    {
        $this->pdo = null;
    }

    public function query(string $sql, $class, array $param = null)
    {
        $method = is_null($param) ? 'query' : 'prepare';

        if (strpos($sql, 'DELETE') === 0
            || strpos($sql, 'UPDATE') === 0
            || strpos($sql, 'INSERT') === 0) {

            var_dump($method);
            $stmt = $this->open()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($class), [$this]);
            $res = $stmt->execute($param);

            return strpos($sql, 'INSERT') === 0 ? $this->pdo->lastInsertId() : $res;
        }

        $stmt = $this->open()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($class), [$this]);

        if ($method !== 'query') {
            $stmt->execute($param);
        }

        return $stmt->fetchAll();
    }
}