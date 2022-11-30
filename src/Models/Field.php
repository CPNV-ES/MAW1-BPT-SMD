<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;

class Field
{
    protected int      $id;
    protected Exercise $exercise;
    protected string   $label;
    protected string   $value_kind;
    protected Query    $query;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->query = new Query(DBConnection::getInstance(), 'fields', Field::class);
        if (array_key_exists('label', $params)) {
            $this->label = $params['label'];
        }
        if (array_key_exists('value_kind', $params)) {
            $this->value_kind = $params['value_kind'];
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
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getValueKind(): string
    {
        return $this->value_kind;
    }

    /**
     * @param string $value_kind
     */
    public function setValueKind(string $value_kind): void
    {
        $this->value_kind = $value_kind;
    }

    /**
     * @return bool
     */
    public function update(): bool
    {
        try {
            return $this->query->update(
                'fields',
                Field::class,
                $this->id,
                [
                    'label'      => $this->getLabel(),
                    'value_kind' => $this->getValueKind(),
                ]
            );
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }
}