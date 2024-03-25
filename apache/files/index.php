<?php
include __DIR__."/autoloader.php";
$controller = \Controller\Dashboard::class;

if (isset($_REQUEST['controller'])) {
    $controller = 'Controller\\'.$_REQUEST['controller'];
}

$controllerObject = new $controller();
if (isset($_REQUEST['action'])) {
    $action = strtolower($_REQUEST['action']);
    if (method_exists($controllerObject, $action)) {
        try {
            $controllerObject->$action();
        } catch (Throwable $exc) {
            $controllerObject->setErrorMessage($exc->getMessage());
        }

    }
}

$controllerObject->render();


