<?php
session_start();

use src\DatabaseConnection;
use src\Template;
use src\Router;
use modules\page\controllers\PageController;

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);


spl_autoload_register(function ($class_name) {
    $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';
// if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

DatabaseConnection::connect('db', 'db', 'db', 'db');

$action = $_GET['seo_name'] ?? 'home';

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);
$router->findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';

if ($router->module == null) {
    include ROOT_PATH . 'view/status-pages/404.html';
    die();
}

$moduleName = ucfirst($router->module) . 'Controller';
$controllerFile = MODULE_PATH . $router->module . '/controllers/' . $moduleName . '.php';

if (file_exists($controllerFile)) {

//    include $controllerFile;
    $controller = new PageController();
    $controller->template = new Template('layout/default');
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}