<?php

namespace App\Database;

class Query
{
    protected DBConnection $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DBConnection::getInstance();
    }

    /**
     * Method to select records from a database table
     *
     * @param string      $table Name of the table to select from
     * @param string      $class Name of the class to use for the result objects
     * @param string|null $conditions Optional WHERE conditions for the SELECT statement
     * @param array|null  $params Optional parameters for the WHERE conditions
     * @param bool        $single Optional flag indicating whether to return a single object or an array of objects
     *
     * @return array|object
     */
    public function select(
        string $table,
        string $class,
        string $conditions = null,
        array $params = null,
        bool $single = false
    ): array|object {
        $sql = "SELECT * FROM {$table}";
        $sql .= $conditions ? " WHERE {$conditions}" : "";
        return $this->dbConnection->execute($sql, $class, $params, $single);
    }

    /**
     * Method to insert a new record into a database table
     *
     * @param string $table Name of the table to insert into
     * @param string $class Name of the class to use for the result objects
     * @param array  $data Array of field values for the new record
     *
     * @return int
     */
    public function insert(string $table, string $class, array $data): int
    {
        $fieldList = implode(', ', array_keys($data));
        $placeholderList = implode(', ', array_map(fn($key) => ":{$key}", array_keys($data)));

        $this->dbConnection->execute(
            "INSERT INTO {$table} ({$fieldList}) VALUES ({$placeholderList})",
            $class,
            $data
        );
        return $this->dbConnection->getLastItemId();
    }

    /**
     * Method to update an existing record in a database table
     *
     * @param string $table Name of the table to update
     * @param string $class Name of the class to use for the result objects
     * @param string $conditions WHERE conditions for the UPDATE statement
     * @param array  $params Parameters for the WHERE conditions
     * @param array  $data Array of updated field values
     *
     * @return bool
     */
    public function update(string $table, string $class, string $conditions, array $params, array $data): bool
    {
        $updateList = implode(
            ', ',
            array_map(fn($key) => "{$key} = :{$key}", array_keys($data))
        );
        $data = array_merge($params, $data);

        return $this->dbConnection->execute(
            "UPDATE {$table} SET {$updateList} WHERE {$conditions}",
            $class,
            $data
        );
    }

    /**
     * Method to delete a record from a database table
     *
     * @param string $table Name of the table to delete from
     * @param string $class Name of the class to use for the result objects
     * @param string $conditions WHERE conditions for the DELETE statement
     * @param array  $params Parameters for the WHERE conditions
     *
     * @return bool
     */
    public function delete(string $table, string $class, string $conditions, array $params): bool
    {
        return $this->dbConnection->execute("DELETE FROM {$table} WHERE {$conditions}", $class, $params);
    }
}
