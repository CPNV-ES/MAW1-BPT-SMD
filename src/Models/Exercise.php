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
     * @param int|null $fieldId
     *
     * @return array|Field
     */
    public function getFields(int $fieldId = null): array|Field
    {
        if (is_null($fieldId)) {
            return $this->query->select('fields', Field::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            return $this->query->select('fields', Field::class, 'id  = :field_id AND exercises_id = :exercises_id', ['field_id' => $fieldId, 'exercises_id' => $this->id], true);
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
     * @param int $fieldId
     *
     * @return void
     */
    public function deleteField(int $fieldId): void
    {
        $this->query->delete('fields', Field::class, 'id = :id', ['id' => $fieldId]);
    }

    /**
     * @param int|null $fulfillment
     *
     * @return array|Fulfillment
     */
    public function getFulfillment(int $fulfillment = null): array|Fulfillment
    {
        if (is_null($fulfillment)) {
            return $this->query->select('fulfillments', Fulfillment::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            return $this->query->select('fulfillments', Fulfillment::class, 'id = :field_id AND exercises_id = :exercises_id', ['field_id' => $fulfillment, 'exercises_id' => $this->id], true);
        }
    }
}