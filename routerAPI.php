<?php
//S?S,y3#uD4.C.M8
require_once 'libs/router/Router.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ShiftController.php';
require_once 'controllers/TherapyController.php';
require_once 'controllers/WorkshopController.php';
require_once 'controllers/QuestionController.php';
require_once 'controllers/NotificationController.php';
include_once('helpers/auth.helper.php');

/*header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Content-Type: application/javascript");
header("Cookies': _test=31be990d9a58de15e0bc20f93d197d02; expires=Thu, 31-Dec- 2037 20:55:55 GTM; path=/");
*/
//define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . '/');
$router = new Router();

//$router->addRoute('recurso', 'verbo', 'controlador', 'funcion');

$router->addRoute('user', 'POST', 'UserController', 'add'); 
$router->addRoute('user/:ID', 'DELETE', 'UserController', 'delete'); 
$router->addRoute('user', 'GET', 'UserController', 'getAll');
$router->addRoute('user/:ID', 'GET', 'UserController', 'getById'); 
$router->addRoute('user/:ID', 'PUT', 'UserController', 'edit');

$router->addRoute('admin/', 'GET', 'UserController', 'getTherapist');

$router->addRoute('log', 'POST', 'UserController', 'verify'); 
$router->addRoute('log/:ID', 'DELETE', 'UserController', 'logout'); 
$router->addRoute('log', 'GET', 'UserController', 'checkSession'); 

$router->addRoute('shift', 'POST', 'ShiftController', 'add');
$router->addRoute('shift/:ID', 'PUT', 'ShiftController', 'confirm');
$router->addRoute('shift/:ID','DELETE', 'ShiftController', 'delete');
$router->addRoute('shift', 'GET', 'ShiftController', 'getAll');
$router->addRoute('shift/:ID', 'GET', 'ShiftController', 'getUserShifts');

$router->addRoute('therapy', 'GET', 'TherapyController', 'getAll'); 
$router->addRoute('therapy/:ID', 'GET', 'TherapyController', 'getById'); 
$router->addRoute('therapy', 'POST', 'TherapyController', 'add');
$router->addRoute('therapy/:ID', 'PUT', 'TherapyController', 'edit');
$router->addRoute('therapy/:ID', 'DELETE', 'TherapyController', 'delete');

$router->addRoute('workshop', 'GET', 'WorkshopController', 'getAll'); 
$router->addRoute('workshop', 'POST', 'WorkshopController', 'add'); 
$router->addRoute('workshop/:ID', 'DELETE', 'WorkshopController', 'delete');
$router->addRoute('workshop/:ID', 'PUT', 'WorkshopController', 'edit');
$router->addRoute('workshopp/:ID', 'PUT', 'WorkshopController', 'addImg');

$router->addRoute('question', 'POST', 'QuestionController', 'add'); 
$router->addRoute('question', 'GET', 'QuestionController', 'getAllToAdmin'); 

$router->addRoute('notification/:ID', 'GET', 'NotificationController', 'getAll');
$router->addRoute('notification', 'POST', 'NotificationController', 'add');
$router->addRoute('notification/:ID', 'DELETE', 'NotificationController', 'delete');
$router->addRoute('notifications/:ID', 'DELETE', 'NotificationController', 'deleteAll');

$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);
?>