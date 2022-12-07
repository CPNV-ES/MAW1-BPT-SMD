<?php

namespace App\Models;

use App\Database\Query;
class FieldsHasFulfillments
{
    protected Field       $field;
    protected Fulfillment $fulfillment;
    protected string      $value;
    protected Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }
    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    public function get(array $field)
    {
        $conditions = "fields_id = (:field_id)";
        $params = ['field_id' => implode(',', $field)];
        return $this->query->select('fields_has_fulfillments', FieldsHasFulfillments::class, $conditions, $params);
    }
}
