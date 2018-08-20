<?php
require_once 'NamespaceAutoloader.php';

$autoloader = new NamespaceAutoloader();
$autoloader->addNamespace('Andrew\Blog\Views', __DIR__ . '/view');
$autoloader->addNamespace('Andrew\Blog\Models', __DIR__ . '/model');
$autoloader->addNamespace('Andrew\Blog\Controllers', __DIR__ . '/controller');
$autoloader->register();

use \Andrew\Blog\Controllers as Controllers;

session_start();

$data = array();
$act = $_GET["act"];


if ($act == null) {
    $controller = new Controllers\MainPageController();
} else if ($act == "logout") {
    session_destroy();
    header("location: /index.php");
    die;
} else if ($act == "login") {
    $controller = new Controllers\LoginController();
} else if ($act == "register") {
    $controller = new Controllers\RegisterController();
} else if ($act == "post") {
    $controller = new Controllers\PostController();
} else if ($act == "posts") {
    $controller = new Controllers\PostsController();
}
if ($controller == null) {
    header("location: /index.php");
}
$controller->process($data);