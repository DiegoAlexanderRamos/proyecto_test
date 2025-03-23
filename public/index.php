<?php
session_start();

// Enrutamiento
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'loginForm';

// Cargar controlador
require_once '../controllers/' . ucfirst($controller) . 'Controller.php';
$controllerName = ucfirst($controller) . 'Controller';
$controllerObj = new $controllerName();

// Ejecutar acción
call_user_func(array($controllerObj, $action));
