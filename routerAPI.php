<?php

require_once 'libs/router/Router.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ShiftController.php';
require_once 'controllers/TherapyController.php';
require_once 'controllers/WorkshopController.php';
require_once 'controllers/QuestionController.php';

//define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$router = new Router();
header('Access-Control-Allow-Origin: http://localhost/4200');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

//$router->addRoute('recurso', 'verbo', 'controlador', 'funcion');

$router->addRoute('user', 'POST', 'UserController', 'add');
$router->addRoute('user/:ID', 'DELETE', 'UserController', 'delete'); //no priority
$router->addRoute('user', 'GET', 'UserController', 'getAllToAdmin'); //TODO
$router->addRoute('user/:ID', 'PUT', 'UserController', 'edit'); //no priority

$router->addRoute('admin/', 'GET', 'UserController', 'getTherapist'); //TODO

$router->addRoute('login', 'POST', 'UserController', 'verify');
$router->addRoute('logout', 'DELETE', 'UserController', 'logout');

$router->addRoute('shift', 'POST', 'ShiftController', 'add');
$router->addRoute('shift/:ID', 'PUT', 'ShiftController', 'confirm');
$router->addRoute('shift/:ID','DELETE', 'ShiftController', 'delete');
$router->addRoute('shift', 'GET', 'ShiftController', 'getAllToAdmin');

$router->addRoute('therapy', 'GET', 'TherapyController', 'getAll');
$router->addRoute('therapy/:ID', 'GET', 'TherapyController', 'getById');
$router->addRoute('therapy', 'POST', 'TherapyController', 'add'); //TODO
$router->addRoute('therapy/:ID', 'PUT', 'TherapyContorller', 'edit');
$router->addRoute('therapy/:D', 'DELETE', 'TherapyController', 'delete');

$router->addRoute('workshop', 'GET', 'WorkshopController', 'getAll');
$router->addRoute('workshop', 'POST', 'WorkshopController', 'add'); //TODO
$router->addRoute('workshop/:ID', 'DELETE', 'WorkshopCntroller', 'delete');
$router->addRoute('workshop/:ID', 'PUT', 'WorkshopController', 'edit');

$router->addRoute('question', 'POST', 'QuestionController', 'add'); //TODO
$router->addRoute('question', 'GET', 'QuestionController', 'getAllToAdmin'); //TODO


$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);
?>