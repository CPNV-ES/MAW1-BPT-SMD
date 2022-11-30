<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;

class Fulfillment
{
    protected int       $id;
    protected Exercise  $exercise;
    protected \DateTime $date;
    protected Query     $queryFulfillments;
    protected Query     $queryFulfillmentsHasFields;

    public function __construct(\DateTime $date, Exercise $exercise)
    {
        $this->queryFulfillments = new Query(DBConnection::getInstance(), 'fulfillments', Fulfillment::class);
        $this->queryFulfillmentsHasFields = new Query(DBConnection::getInstance(), 'fields_has_fulfillments', Fulfillment::class);
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
            $fulfillmentsId = $this->queryFulfillments->insert(['date' => $this->date->format('Y-m-d H:i:s'), 'exercises_id' => $this->exercise->getId()]);
            foreach ($answers as $key => $answer) {
                $this->queryFulfillmentsHasFields->insert(['fulfillments_id' => $fulfillmentsId, 'fields_id' => $key, 'value' => $answer]);
            }
            return $fulfillmentsId;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }
}
