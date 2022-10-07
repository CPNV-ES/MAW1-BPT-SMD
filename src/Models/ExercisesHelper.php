<?php

namespace App\Models;

use App\Database\Query;

class ExercisesHelper
{
    protected Query $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function get(array $ids = null): array
    {
        if (is_null($ids)) {
            return $this->query->select();
        } else {
            $conditions = "id IN :id";
            $params['id'] = '(' . implode(',', $ids) . ')';
            return $this->query->select($conditions, $params);
        }
    }

    public function create(Exercise $exercise): bool
    {
        return $this->query->insert(['title' => $exercise->getTitle()]);
    }

    public function delete(int $id): void
    {
        $this->query->delete($id);
    }
}