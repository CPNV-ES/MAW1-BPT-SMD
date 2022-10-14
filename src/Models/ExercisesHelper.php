<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;

class ExercisesHelper
{
    protected Query $query;


    public function __construct(DBConnection $dbConnection)
    {
        $this->query = new Query($dbConnection, 'exercises', Exercise::class);
    }

    /**
     * @param array|null $id
     *
     * @return array
     */
    public function get(array $id = null): array
    {
        if (is_null($id)) {
            return $this->query->select();
        } else {
            $conditions = "id IN :id";
            $params = array(':id' => $id);
            return $this->query->select($conditions, $params);
        }
    }

    /**
     * @param Exercise $exercise
     *
     * @return int
     */
    public function create(Exercise $exercise): int
    {
        try {
            return $this->query->insert(['title' => $exercise->getTitle(), 'state' => $exercise->getState()]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $this->query->delete($id);
    }
}