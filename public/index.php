<?php

use App\Controllers\ExerciseController;
use App\Controllers\FieldsController;
use App\Controllers\HomeController;
use App\Router\Router;

require '../vendor/autoload.php';

define('TEMPLATES_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('SCRIPTS_DIR', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

define('DB_HOST', 'localhost');
define('DB_NAME', 'looper');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
const DB_PASSWORD = '';

$router = new Router();

$router->get('/', HomeController::class . '::index');

$router->get('/exercises', ExerciseController::class . '::index');
$router->post('/exercises', ExerciseController::class . '::createExercise');
$router->get('/exercises/new', ExerciseController::class . '::create');
$router->post('/exercises/:id', ExerciseController::class . '::delete');

$router->get('/exercises/:id/fields', FieldsController::class . '::index');

$router->run();