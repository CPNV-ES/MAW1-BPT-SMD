<?php

use App\Controllers\ExerciseController;
use App\Controllers\FieldsController;
use App\Controllers\HomeController;
use App\Router\Route;
use App\Router\Router;

require '../vendor/autoload.php';
require_once 'const.php';

define('TEMPLATES_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('SCRIPTS_DIR', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = Router::getInstance();

$router->add('home_index', new Route('/', HomeController::class, 'index'));

$router->add('exercises_index', new Route('/exercises', ExerciseController::class, 'index'));
$router->add('exercises_new', new Route('/exercises/new', ExerciseController::class, 'new'));
$router->add('exercises_delete', new Route('/exercises/:id', ExerciseController::class, 'delete'));

$router->add('fields_index', new Route('/exercises/:id/fields', FieldsController::class, 'index'));
$router->add('fields_new', new Route('/exercises/:id/fields/new', FieldsController::class, 'new'));

$router->run();