<?php

class db
{
    private $mysqlClient;
    function __construct() {
        $this->mysqlClient = new PDO('mysql:host=localhost;dbname=looper;charset=utf8', 'root', '');
    }

    function createExercice($titile){
        $preparedStatement = $this->mysqlClient->prepare('INSERT INTO exercises (title) VALUES (:title)');

        $preparedStatement->execute([ 'title' => $titile ]);

        return $this->mysqlClient->lastInsertId();
    }
}