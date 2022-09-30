<?php


class ExercisesHelper
{
    protected Query $query;

    public function __construct (Query $query)
    {
        $this->query = $query;
    }

    public function get (array $id = null): array
    {
        if (is_null($id)) {
            return $this->query->select();
        } else {
            $conditions = "id IN :id";
            $params = array(':id' => $id);
            return $this->query->select($conditions, $params);
        }
    }

    public function create (string $title): void
    {
        $params = compact('title');
        $this->query->insert($params);
    }

    public function delete (int $id): void
    {
        $this->query->delete($id);
    }
}