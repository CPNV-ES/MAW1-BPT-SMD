<?php

namespace App\Models;

use App\Database\Query;
use PDOException;

class Fulfillment
{
    protected int      $id;
    protected Exercise $exercise;
    protected string   $date;
    protected Query    $query;

    public function __construct(array $params = [])
    {
        $this->query = new Query();
        if (array_key_exists('date', $params)) {
            $this->date = $params['date'];
        }
        if (array_key_exists('exercise', $params)) {
            $this->exercise = $params['exercise'];
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
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param array $answers
     *
     * @return int
     */
    public function save(array $answers = []): int
    {
        if (!isset($this->id)) {
            return $this->create($answers);
        } else {
            return $this->update($answers);
        }
    }

    /**
     * @param array $answers
     *
     * @return int
     */
    protected function create(array $answers = [[]]): int
    {
        try {
            $fulfillmentsId = $this->query->insert(
                'fulfillments',
                Fulfillment::class,
                ['date' => $this->date, 'exercises_id' => $this->exercise->getId()]
            );
            foreach ($answers as $key => $answer) {
                $this->query->insert(
                    'fields_has_fulfillments',
                    Fulfillment::class,
                    ['fulfillments_id' => $fulfillmentsId, 'fields_id' => $key, 'value' => $answer]
                );
            }
            return $fulfillmentsId;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * @param array $answers
     *
     * @return int
     */
    protected function update(array $answers = [[]]): int
    {
        try {
            foreach ($answers as $fields_id => $answer) {
                $this->query->update(
                    'fields_has_fulfillments',
                    Fulfillment::class,
                    'fields_id = :fields_id AND fulfillments_id = :fulfillments_id',
                    [
                        'fields_id'       => $fields_id,
                        'fulfillments_id' => $this->id,
                    ],
                    [
                        'value' => $answer,
                    ]
                );
            }
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * @param Field $field
     *
     * @return string
     */
    public function getValue(Field $field): string
    {
        $fieldsHasFulfillments = $this->query->select(
            'fields_has_fulfillments',
            FieldsHasFulfillments::class,
            'fields_id = :fields_id AND fulfillments_id = :fulfillments_id',
            [
                ':fields_id'       => $field->getId(),
                ':fulfillments_id' => $this->id,
            ],
            true
        );
        return $fieldsHasFulfillments->getValue();
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->query->delete(
            'fields_has_fulfillments',
            FieldsHasFulfillments::class,
            'fulfillments_id = :fulfillments_id',
            ['fulfillments_id' => $this->id]
        );
        $this->query->delete('fulfillments', Fulfillment::class, 'id = :id', ['id' => $this->id]);
    }
}
