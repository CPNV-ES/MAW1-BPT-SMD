<?php

class DB
{
    private $conn;

    function __construct()
    {
        $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD);
    }

    // Select query
    function select($table)
    {
        $select = $this->conn->prepare("SELECT * FROM $table");

        $select->execute();

        return $select->fetchAll();
    }

    // Insert query
    function insert($table, $keys, $values)
    {
        $insert = $this->conn->prepare("INSERT INTO $table ($keys) VALUES (:values)");

        $insert->execute(['values' => $values]);

        return $this->conn->lastInsertId();
    }
}