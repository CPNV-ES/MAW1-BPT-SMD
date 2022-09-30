<?php


class ExercisesHelper
{
    protected $params;
    protected $conditions;

    public function __construct (query $query)
    {
        $this->query = $query;
    }

    public function get ($id = null)
    {
        if (is_null($id)) {
            return $this->query->Select();
        } else {
            $conditions = "id IN :id";
            $params = array(':id' => $id);
            return $this->query->Select($conditions, $params);
        }
    }

    public function create ($title, $state)
    {
        $params = ['title' => $title, 'state' => $state];
        return $this->query->Insert($params);
    }

    public function delete ($id)
    {
        return $this->query->Delete($id);
    }
}