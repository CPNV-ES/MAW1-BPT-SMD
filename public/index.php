<?php

use App\Controllers\ExerciseController;
use App\Controllers\FieldsController;
use App\Controllers\FulfillmentController;
use App\Controllers\HomeController;
use App\Database\DBConnection;
use App\Router\Route;
use App\Router\Router;

require_once '../vendor/autoload.php';
require_once 'const.php';

define('TEMPLATES_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('SCRIPTS_DIR', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

DBConnection::setUp(DB_DNS, DB_USER, DB_PASSWORD);

$router = Router::getInstance();

$router->get('home_index', new Route('/', HomeController::class, 'index'));

$router->get('exercises_index', new Route('/exercises', ExerciseController::class, 'index'));
$router->get('exercises_new', new Route('/exercises/new', ExerciseController::class, 'new'));
$router->post('exercises_create', new Route('/exercises/new', ExerciseController::class, 'new'));
$router->post('exercises_state', new Route('/exercises/:id/state', ExerciseController::class, 'state'));
$router->post('exercises_delete', new Route('/exercises/:id', ExerciseController::class, 'delete'));

$router->get('fields_index', new Route('/exercises/:id/fields', FieldsController::class, 'index'));
$router->post('fields_create', new Route('/exercises/:id/fields', FieldsController::class, 'index'));
$router->get('fields_edit', new Route('/exercises/:id1/fields/:id2/edit', FieldsController::class, 'edit'));
$router->post('fields_update', new Route('/exercises/:id1/fields/:id2/edit', FieldsController::class, 'edit'));
$router->post('fields_delete', new Route('/exercises/:id1/fields/:id2', FieldsController::class, 'delete'));

$router->get('fulfillments_new', new Route('/exercises/:id/fulfillments/new', FulfillmentController::class, 'new'));
$router->post('fulfillments_create', new Route('/exercises/:id/fulfillments/new', FulfillmentController::class, 'create'));

$router->run();
