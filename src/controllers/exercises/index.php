<?php

require_once SOURCE_DIR . '/models/exercises.php';

$bag['data'] = ['exercises' => getAllExercises()];
$bag['view'] = 'views/exercises/index';

return $bag;
