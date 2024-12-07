<?php
require_once "controllers/TodfController.php";

$controller = new TodfController();

$action = $_GET['action'] ?? 'showHome';  // Definir la acción predeterminada

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Acción no encontrada.";
}
