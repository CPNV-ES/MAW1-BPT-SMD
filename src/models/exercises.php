<?php

require_once SOURCE_DIR . '/controllers/db.php';

function createExercice($title)
{
    $db = new db();
    return $db->createExercice($title);
}