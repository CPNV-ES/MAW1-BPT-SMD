<?php

namespace App\Models;

use App\Database\DBConnection;

abstract class Model
{

    protected DBConnection $db;
    protected string $table;

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function all(): array
    {
        return $this->db->query("SELECT * FROM {$this->table}", $this);
    }

    public function findById(int $id): Model
    {
        return $this->db->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function create(array $data, ?array $relations = null)
    {
        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ", ";
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }
        return $this->db->query("INSERT INTO {$this->table} ($firstParenthesis)
        VALUES($secondParenthesis)", $this, $data
        );
    }

    public function update(int $id, array $data, ?array $relations = null)
    {
        $sqlRequestPart = "";
        $i = 1;

        foreach ($data as $key => $value) {
            $comma = $i === count($data) ? "" : ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }

        $data['id'] = $id;

        return $this->db->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $this, $data);
    }

    public function destroy(int $id): bool
    {
        return $this->db->query("DELETE FROM {$this->table} WHERE id = ?", $this, [$id]);
    }
}