<?php


require_once SOURCE_DIR . '/models/model.php';

function getAllExercises()
{
    $db = new DB();
    return $db->select('exercises');
}

function createExercise($title)
{
    $db = new DB();
    return $db->insert('exercises', 'title', $title);
}