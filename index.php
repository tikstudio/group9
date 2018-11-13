<?php
session_start();

include 'configs.php';
include 'autoload.php';

if (isset($_COOKIE['time-zone'])) {
    date_default_timezone_set($_COOKIE['time-zone']);
}


$referer = str_replace(ROOT_DIR, '', $_SERVER['REQUEST_URI']);
$referer_arr = explode('/', trim($referer, '/'));

if (empty($referer_arr[0])) {
    $referer_arr[0] = 'login';
}

if (empty($referer_arr[1])) {
    $referer_arr[1] = 'index';
}

$controller_name = ucfirst($referer_arr[0]);
$controller_name = 'controller\\' . $controller_name . 'Controller';


if (class_exists($controller_name)) {
    $controller = new $controller_name();

    $action_name = ucwords(str_replace('-', ' ', $referer_arr[1]));
    $action_name = 'action' . str_replace(' ', '', $action_name);

    if (method_exists($controller, $action_name)) {
        $controller->$action_name();
    } else {
        controller\Controller::error404();
    }
} else {
    controller\Controller::error404();
}


?>
