<?php
require_once("config.php");

// 🚨 SI SE SOLICITA LOGIN, NO CARGAR CONTROLADOR
if (isset($_GET['m']) && in_array($_GET['m'], ['login', 'validar', 'registrar'])) {
    require_once("controlador/index.php");
    $metodo = $_GET['m'];
    modeloController::{$metodo}();
    exit;
}


// Solo cargar el controlador si no estamos en login
require_once("controlador/index.php");

if (isset($_GET['m'])) {
    $metodo = $_GET['m'];
    if (method_exists("modeloController", $metodo)) {
        modeloController::{$metodo}();
    } else {
        modeloController::index();
    }
} else {
    modeloController::index();
}
?>
