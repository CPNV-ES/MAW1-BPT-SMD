<?php

namespace App\Database;

use PDOException;

/**
 * Query
 */
class Query
{
    protected DBConnection $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DBConnection::getInstance();
    }

    /**
     * Select elements with filter
     *
     * @param string|null $conditions
     * @param array|null  $params
     * @param bool        $single
     *
     * @return array|object
     */
    public function select(string $table, string $class, string $conditions = null, array $params = null, bool $single = false): array|object
    {
        $sql = "SELECT * FROM {$table}";
        $sql .= $conditions ? " WHERE {$conditions}" : "";
        return $this->dbConnection->execute($sql, $class, $params, $single);
    }

    /**
     * Create one element
     *
     * @param array $data array of fields name and value
     *
     * @return int
     */
    public function insert(string $table, string $class, array $data): int
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

        $this->dbConnection->execute(
            "INSERT INTO {$table} ($firstParenthesis) VALUES ($secondParenthesis)",
            $class,
            $data
        );
        return $this->dbConnection->getLastItemId();
    }

    /**
     * Update one element by his id
     *
     * @param int   $id   id of object
     * @param array $data array of fields name and value to update
     *
     * @return bool
     */
    public function update(string $table, string $class, int $id, array $data): bool
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;

        return $this->dbConnection->execute(
            "UPDATE {$table} SET {$sqlRequestPart} WHERE id = :id",
            $class,
            $data
        );
    }

    /**
     * Create one element
     *
     * @param int $id id of object
     *
     * @return bool
     */
    public function delete(string $table, string $class, int $id): bool
    {
        return $this->dbConnection->execute("DELETE FROM {$table} WHERE id = :id", $class, compact('id'));
    }
}