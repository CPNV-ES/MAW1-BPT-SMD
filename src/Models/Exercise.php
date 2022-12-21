<?php

namespace App\Models;

use App\Database\Query;
use PDOException;

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
     * Getter method for the id property.
     *
     * @return int|null The id of the exercise, or null if not set.
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    /**
     * Getter method for the title property.
     *
     * @return string The title of the exercise.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter method for the title property.
     *
     * @param string $title The new title for the exercise.
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter method for the state property.
     *
     * @return string The state of the exercise.
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Setter method for the state property.
     *
     * @param string $state The new state for the exercise.
     *
     * @return void
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * Retrieve all fields belonging to an exercise, or a specific field if an id is provided.
     *
     * @param int|null $fieldId The id of the field to retrieve, or null to retrieve all fields.
     *
     * @return array|Field An array of Field objects, or a single Field object if an id was provided.
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
     * Create a new field for an exercise.
     *
     * @param Field $field The field to create.
     *
     * @return int The id of the newly created field.
     */
    public function createField(Field $field): int
    {
        try {
            return $this->query->insert('fields', Field::class, [
                'label'        => $field->getLabel(),
                'value_kind'   => $field->getValueKind(),
                'exercises_id' => $this->id,
            ]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }


    /**
     * Delete a field from an exercise.
     *
     * @param int $fieldId The id of the field to delete.
     *
     * @return void
     */
    public function deleteField(int $fieldId): void
    {
        foreach ($this->getFulfillments() as $fulfillment) {
            $fulfillment->delete();
        }
        $this->query->delete('fields', Field::class, 'id = :id', ['id' => $fieldId]);
    }

    /**
     * Retrieve all fulfillments belonging to an exercise, or a specific fulfillment if an id is provided.
     *
     * @param int|null $fulfillment The id of the fulfillment to retrieve, or null to retrieve all fulfillments.
     *
     * @return array|Fulfillment An array of Fulfillment objects, or a single Fulfillment object if an id was provided.
     */
    public function getFulfillments(int $fulfillment = null): array|Fulfillment
    {
        if (is_null($fulfillment)) {
            return $this->query->select('fulfillments', Fulfillment::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            return $this->query->select(
                'fulfillments',
                Fulfillment::class,
                'id = :field_id AND exercises_id = :exercises_id',
                ['field_id' => $fulfillment, 'exercises_id' => $this->id],
                true
            );
        }
    }
}