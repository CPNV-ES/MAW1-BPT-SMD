<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;

class Fulfillment
{
    protected int $id;
    protected Exercise $exercise;
    protected \DateTime $date;
    protected Query $query;

    public function __construct(\DateTime $date, Exercise $exercise)
    {
        $this->query = new Query(DBConnection::getInstance(), 'fulfillments', Fulfillment::class);
        $this->date = $date;
        $this->exercise = $exercise;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param array $values
     *
     * @return int
     */
    public function save(array $values = []): int
    {
        if (!isset($this->id)) {
            return $this->create($values);
        } else {
            return $this->update($values);
        }
    }

    protected function create(array $values = []): int
    {
        try {
            return $this->query->insert(['date' => $this->date->format('Y-m-d H:i:s'), 'exercises_id' => $this->exercise->getId()]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }
}
