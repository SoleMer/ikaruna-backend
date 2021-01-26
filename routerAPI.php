<?php

require_once 'libs/router/Router.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ShiftController.php';
require_once 'controllers/TherapyController.php';
require_once 'controllers/WorkshopController.php';
require_once 'controllers/QuestionController.php';

$router = new Router();

//$router->addRoute('recurso', 'verbo', 'controlador', 'funcion');
//$router->addRoute('comments/product/:ID', 'GET', 'ApiController', 'getComments'); //obtener todos los comentarios de un producto

$router->addRoute('user', 'POST', 'UserController', 'add');
$router->addRoute('user/:ID', 'DELETE', 'UserController', 'delete');
$router->addRoute('user', 'GET', 'UserController', 'getAll');
$router->addRoute('user/:ID', 'PUT', 'UserController', 'edit');

$router->addRoute('login', 'POST', 'UserController', 'verify');
$router->addRoute('logout', 'DELETE', 'UserController', 'logout');

$router->addRoute('shift', 'POST', 'ShiftController', 'add');
$router->addRoute('shift/:ID', 'PUT', 'ShiftCntroller', 'edit');
$router->addRoute('shift/:ID','DELETE', 'ShiftController', 'delete');
$router->addRpute('shift', 'GET', 'ShiftController', 'getAll');

$router->addRoute('therapy', 'GET', 'TherapyController', 'getAll');
$router->addRoute('therapy', 'POST', 'TherapyController', 'add');
$router->addRoute('therapy/:ID', 'PUT', 'TherapyContorller', 'edit');
$router->addRoute('therapy/:D', 'DELETE', 'TherapyController', 'delete');

$router->addRoute('workshop', 'GET', 'WorkshopController', 'getAll');
$router->addRoute('workshop', 'POST', 'WorkshopController', 'add');
$router->addRoute('workshop/:ID', 'DELETE', 'WorkshopCntroller', 'delete');
$router->addRoute('workshop/:ID', 'PUT', 'WorkshopController', 'edit');

$router->addRoute('question', 'POST', 'QuestionController', 'add');
$router->addRoute('question', 'GET', 'QuestionController', 'getAll');
?>