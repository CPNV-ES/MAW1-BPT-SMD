<?php

namespace App\Models;

use App\Database\Query;
use PDOException;

/**
 * Exercise
 */
class Exercise
{
    protected int    $id;
    protected string $title;
    protected string $state = 'building';
    protected Query  $query;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->query = new Query();
        if (array_key_exists('title', $params)) {
            $this->title = $params['title'];
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
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

    /**
     * @param array|null $id
     *
     * @return array
     */
    public function getFields(array $id = null): array
    {
        if (is_null($id)) {
            return $this->query->select('fields', Field::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            $conditions = "id IN (:id)";
            $params = ['id' => implode(',', $id)];
            return $this->query->select('fields', Field::class, $conditions, $params);
        }
    }

    /**
     * @param Field $field
     *
     * @return int
     */
    public function createField(Field $field): int
    {
        try {
            return $this->query->insert('fields', Field::class, [
                'label'        => $field->getLabel(),
                'value_kind'   => $field->getValueKind(),
                'exercises_id' => $this->id
            ]);
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
    public function deleteField(int $id): void
    {
        $this->query->delete('fields', Field::class, 'id = :id', ['id' => $id]);
    }

    public function getFulfillments($id = null)
    {
        if (is_null($id)) {
            return $this->query->select('fulfillments', Fulfillment::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            return $this->query->select('fulfillments', Fulfillment::class, 'id = :id', ['id' => $id], true);
        }
    }
}