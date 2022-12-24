<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;

/**
 * This class provides methods for manipulating Exercise objects
 */
class ExerciseHelper
{
    protected Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    /**
     * Method to get one or all Exercise objects
     *
     * @param int|null $exerciseId optional parameter to specify the id of the Exercise object to retrieve
     *
     * @return array|Exercise returns an array of Exercise objects or a single Exercise object if an id is specified
     */
    public function get(int $exerciseId = null): array|Exercise
    {
        if (is_null($exerciseId)) {
            return $this->query->select('exercises', Exercise::class);
        } else {
            return $this->query->select('exercises', Exercise::class, 'id = :id', ['id' => $exerciseId], true);
        }
    }

    /**
     * Method to save a new or existing Exercise object
     *
     * @param Exercise $exercise the Exercise object to save
     *
     * @return int returns the id of the saved Exercise object
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
     * Private method to create a new Exercise object
     *
     * @param Exercise $exercise the Exercise object to create
     *
     * @return int returns the id of the created Exercise object
     */
    private function create(Exercise $exercise): int
    {
        try {
            return $this->query->insert(
                'exercises',
                Exercise::class,
                ['title' => $exercise->getTitle(), 'state' => $exercise->getState()]
            );
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * Private method to update an existing Exercise object
     *
     * @param Exercise $exercise the Exercise object to update
     *
     * @return int returns the id of the updated Exercise object
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
     * Method to delete an Exercise object
     *
     * @param int $exerciseId the id of the Exercise object to delete
     *
     * @return bool returns true if the Exercise object was successfully deleted, false otherwise
     */
    public function delete(int $exerciseId): bool
    {
        $exercise = $this->get($exerciseId);
        $pdo = DBConnection::getInstance()->getPDO();
        try {
            $pdo->beginTransaction();
            foreach ($exercise->getFields() as $field) {
                $exercise->deleteField($field->getId());
            }
            $this->query->delete('exercises', Exercise::class, 'id = :id', ['id' => $exerciseId]);
            $pdo->commit();
            return true;
        } finally {
            // If the transaction has not been committed, roll it back
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
                return false;
            }
        }
    }
}