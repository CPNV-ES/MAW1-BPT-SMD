<?php

use App\Controllers\ExerciseController;
use App\Controllers\FieldsController;
use App\Controllers\HomeController;
use App\Router\Router;

require '../vendor/autoload.php';
require_once 'const.php';

define('TEMPLATES_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('SCRIPTS_DIR', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);


$router = Router::getInstance();

$router->get('/', HomeController::class . '::index');

$router->get('/exercises', ExerciseController::class . '::index');
$router->get('/exercises/new', ExerciseController::class . '::create');
$router->post('/exercises/new', ExerciseController::class . '::createExercise');
$router->post('/exercises/:id', ExerciseController::class . '::delete');

$router->get('/exercises/:id/fields', FieldsController::class . '::index');
$router->post('/exercises/:id/fields/new', FieldsController::class . '::create');

$router->run();