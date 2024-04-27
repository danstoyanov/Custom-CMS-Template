<?php

session_start();

// TODO delete this file!
define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'c95mgkf837fkv0skci5u3wi22icmmdkow7');

require_once(ROOT_PATH . 'src/DatabaseConnection.php');
require_once(ROOT_PATH . 'src/Entity.php');
require_once(ROOT_PATH . 'src/Auth.php');
require_once(MODULE_PATH . 'user/models/User.php');

// Connect to the Db
DatabaseConnection::connect('db', 'db', 'db', 'db');

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();
$userObj = new User($dbc);

$userObj->findBy('username', 'admin');

$authObj = new Auth();
$userObj = $authObj->changeUserPassword($userObj, 'correct');

echo '<pre>';
var_dump($userObj);
echo '</pre>';