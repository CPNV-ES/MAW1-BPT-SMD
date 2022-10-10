<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;

/**
 *
 */
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
     * @return bool
     */
    public function create(Exercise $exercise): bool
    {
        return $this->query->insert(['title' => $exercise->getTitle(), 'state' => $exercise->getState()]);
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

    public function getOneByTitle(string $title): array
    {
        $conditions = "title = :title";
        $params = ['title' => $title];
        return $this->query->select($conditions, $params);
    }
}