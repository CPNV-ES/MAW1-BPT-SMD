<?php

require_once SOURCE_DIR . '/models/exercises.php';

if ($_POST) {
    $id = createExercise($_POST['exercise_title']);
    header('Location: /exercises/' . $id . '/fields');
}

$bag['data'] = [];
$bag['view'] = 'views/exercises/new';

return $bag;
