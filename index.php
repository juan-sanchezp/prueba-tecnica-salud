<?php
session_start();
require_once 'config/database.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'cita';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch($controller) {
    case 'cita':
        require_once 'controllers/CitaController.php';
        $controllerObj = new CitaController();
        break;
    case 'factura':
        require_once 'controllers/FacturaController.php';
        $controllerObj = new FacturaController();
        break;
    default:
        require_once 'controllers/CitaController.php';
        $controllerObj = new CitaController();
        break;
}

if(method_exists($controllerObj, $action)) {
    $controllerObj->$action();
} else {
    die("Método no encontrado");
}
?>
