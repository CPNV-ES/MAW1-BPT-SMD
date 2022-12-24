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

DBConnection::setUp(DB_DNS, DB_USER, DB_PASSWORD);

$router = Router::getInstance();

$router->get('home_index', new Route('/', HomeController::class, 'index'));

$router->get('exercises_index', new Route('/exercises', ExerciseController::class, 'index'));
$router->get('exercises_new', new Route('/exercises/new', ExerciseController::class, 'new'));
$router->get('exercises_answering', new Route('/exercises/answering', ExerciseController::class, 'answering'));
$router->post('exercises_create', new Route('/exercises/new', ExerciseController::class, 'new'));
$router->post('exercises_state', new Route('/exercises/:exercise/state', ExerciseController::class, 'state'));
$router->post('exercises_delete', new Route('/exercises/:exercise', ExerciseController::class, 'delete'));
$router->get('exercises_results', new Route('/exercises/:exercise/results', ExerciseController::class, 'results'));

$router->get('fields_index', new Route('/exercises/:exercise/fields', FieldsController::class, 'index'));
$router->post('fields_create', new Route('/exercises/:exercise/fields', FieldsController::class, 'index'));
$router->get('fields_edit', new Route('/exercises/:exercise/fields/:field/edit', FieldsController::class, 'edit'));
$router->post('fields_update', new Route('/exercises/:exercise/fields/:field/edit', FieldsController::class, 'edit'));
$router->post('fields_delete', new Route('/exercises/:exercise/fields/:field', FieldsController::class, 'delete'));
$router->get('fields_results', new Route('/exercises/:exercise/results/:field', FieldsController::class, 'results'));

$router->get('fulfillments_new', new Route('/exercises/:exercise/fulfillments/new', FulfillmentController::class, 'new'));
$router->post('fulfillments_create', new Route('/exercises/:exercise/fulfillments/create', FulfillmentController::class, 'create'));
$router->get('fulfillments_edit', new Route('/exercises/:exercise/fulfillments/:fulfillment/edit', FulfillmentController::class, 'edit'));
$router->post('fulfillments_update', new Route('/exercises/:exercise/fulfillments/:fulfillment/update', FulfillmentController::class, 'update'));
$router->get('fulfillments_results', new Route('/exercises/:exercise/fulfillments/:fulfillment', FulfillmentController::class, 'results'));

$router->run();
