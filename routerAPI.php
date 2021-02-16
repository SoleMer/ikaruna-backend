<?php

require_once 'libs/router/Router.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ShiftController.php';
require_once 'controllers/TherapyController.php';
require_once 'controllers/WorkshopController.php';
require_once 'controllers/QuestionController.php';

//define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$router = new Router();
header('Access-Control-Allow-Origin: http://localhost:4200');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

//$router->addRoute('recurso', 'verbo', 'controlador', 'funcion');

$router->addRoute('user', 'POST', 'UserController', 'add'); 
$router->addRoute('user/:ID', 'DELETE', 'UserController', 'delete'); 
$router->addRoute('user', 'GET', 'UserController', 'getAll');
$router->addRoute('user/:ID', 'GET', 'UserController', 'getById'); 
$router->addRoute('user/:ID', 'PUT', 'UserController', 'edit');

$router->addRoute('admin/', 'GET', 'UserController', 'getTherapist');

$router->addRoute('login', 'POST', 'UserController', 'verify'); 
$router->addRoute('logout', 'DELETE', 'UserController', 'logout'); 

$router->addRoute('shift', 'POST', 'ShiftController', 'add');
$router->addRoute('shift/:ID', 'PUT', 'ShiftController', 'confirm');
$router->addRoute('shift/:ID','DELETE', 'ShiftController', 'delete');
$router->addRoute('shift', 'GET', 'ShiftController', 'getAll');

$router->addRoute('therapy', 'GET', 'TherapyController', 'getAll'); 
$router->addRoute('therapy/:ID', 'GET', 'TherapyController', 'getById'); 
$router->addRoute('therapy', 'POST', 'TherapyController', 'add');
$router->addRoute('therapy/:ID', 'PUT', 'TherapyController', 'edit');
$router->addRoute('therapy/:ID', 'DELETE', 'TherapyController', 'delete');

$router->addRoute('workshop', 'GET', 'WorkshopController', 'getAll'); //DONE
$router->addRoute('workshop', 'POST', 'WorkshopController', 'add'); //DONE
$router->addRoute('workshop/:ID', 'DELETE', 'WorkshopController', 'delete');
$router->addRoute('workshop/:ID', 'PUT', 'WorkshopController', 'edit');

$router->addRoute('question', 'POST', 'QuestionController', 'add'); //DONE
$router->addRoute('question', 'GET', 'QuestionController', 'getAllToAdmin'); //DONE


$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);
?>