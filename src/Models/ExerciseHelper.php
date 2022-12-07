<?php

namespace App\Models;

use App\Database\Query;
use PDOException;

class ExerciseHelper
{
    protected Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    /**
     * @param array|null $id
     *
     * @return array
     */
    public function get(array $id = null): array
    {
        if (is_null($id)) {
            return $this->query->select('exercises', Exercise::class);
        } else {
            $conditions = "id IN (:id)";
            $params = ['id' => implode(',', $id)];
            return $this->query->select('exercises', Exercise::class, $conditions, $params);
        }
    }

    /**
     * @param Exercise $exercise
     *
     * @return int
     */
    public function save(Exercise $exercise): int
    {
        if (is_null($exercise->getId())) {
            return $this->create($exercise);
        } else {
            return $this->update($exercise);
        }
    }

    /**
     * @param Exercise $exercise
     *
     * @return int
     */
    private function create(Exercise $exercise): int
    {
        try {
            return $this->query->insert('exercises', Exercise::class, ['title' => $exercise->getTitle(), 'state' => $exercise->getState()]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * @param Exercise $exercise
     *
     * @return int
     */
    private function update(Exercise $exercise): int
    {
        try {
            return $this->query->update(
                'exercises',
                Exercise::class,
                'id = :id',
                ['id' => $exercise->getId()],
                ['title' => $exercise->getTitle(), 'state' => $exercise->getState()]
            );
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
        $exercise = $this->get([$id])[0];
        foreach ($exercise->getFulfillment() as $fulfillment) {
            $fulfillment->delete();
        }
        foreach ($exercise->getFields() as $field) {
            $exercise->deleteField($field->getId());
        }
        $this->query->delete('exercises', Exercise::class, 'id = :id', ['id' => $id]);
    }
}