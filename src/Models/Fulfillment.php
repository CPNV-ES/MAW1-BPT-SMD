<?php

namespace App\Models;

use App\Database\DBConnection;
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

    protected function create(array $answers = [[]]): int
    {
        try {
            $fulfillmentsId = $this->query->insert('fulfillments', Fulfillment::class, ['date' => $this->date, 'exercises_id' => $this->exercise->getId()]);
            foreach ($answers as $key => $answer) {
                $this->query->insert('fields_has_fulfillments', Fulfillment::class, ['fulfillments_id' => $fulfillmentsId, 'fields_id' => $key, 'value' => $answer]);
            }
            return $fulfillmentsId;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }
}
