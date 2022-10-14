<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;

/**
 * Exercise
 */
class Exercise
{
    protected int    $id;
    protected string $title;
    protected string $state = 'Building';
    protected Query  $query;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->query = new Query(DBConnection::getInstance(), 'fields', Field::class);
        if (array_key_exists('title', $params)) {
            $this->title = $params['title'];
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getAllFields(): array
    {
        return $this->query->select('exercise_id = :id', [':id' => $this->id]);
    }

    /**
     * @param Field $field
     *
     * @return int
     */
    public function createField(Field $field): int
    {
        try {
            return $this->query->insert([
                'label' => $field->getLabel(),
                'value' => $field->getValue(),
                'exercise_id' => $this->id
            ]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * @param $id
     *
     * @return void
     */
    public function deleteField($id): void
    {
        $this->query->delete($id);
    }
}