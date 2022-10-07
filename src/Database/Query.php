<?php

namespace App\Database;

use PDOException;

/**
 * Query
 */
class Query
{
    protected DBConnection $dbConnection;
    protected string       $table;
    protected string       $class;

    /**
     * @param DBConnection $db
     * @param string       $table
     * @param string       $class
     */
    public function __construct(DBConnection $dbConnection, string $table, string $class)
    {
        $this->dbConnection = $dbConnection;
        $this->table = $table;
        $this->class = $class;
    }

    /**
     * Select elements with filter
     *
     * @param string|null $conditions
     * @param array|null  $params
     *
     * @return array
     */
    public function select(string $conditions = null, array $params = null): array
    {
        $sql = "SELECT * FROM {$this->table}";
        $sql .= $conditions ? " WHERE {$conditions}" : "";
        return $this->dbConnection->execute($sql, $this->class, $params);
    }

    /**
     * Create one element
     *
     * @param array $data array of fields name and value
     *
     * @return int
     */
    public function insert(array $data): int
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ", ";
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }

//        try {
        $this->dbConnection->execute("INSERT INTO {$this->table} ($firstParenthesis) VALUES ($secondParenthesis)", $this->class, $data);
        return $this->dbConnection->getLastItemId();
//            return true;
//        } catch (PDOException $e) {
//            error_log($e);
//            return false;
//        }
    }

    /**
     * Update one element by his id
     *
     * @param int   $id   id of object
     * @param array $data array of fields name and value to update
     *
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;

        return $this->dbConnection->execute("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $this->class, $data);
    }

    /**
     * Create one element
     *
     * @param int $id id of object
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->dbConnection->execute("DELETE FROM {$this->table} WHERE id = :id", $this->class, compact('id'));
    }
}