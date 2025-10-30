<?php
require_once("config.php");

// 🚨 SI SE SOLICITA LOGIN, NO CARGAR CONTROLADOR
if (isset($_REQUEST['m']) && in_array($_REQUEST['m'], ['login', 'validar', 'registrar'])) {
    require_once("controlador/index.php");
    $metodo = $_REQUEST['m'];
    modeloController::{$metodo}();
    exit;
}


// Solo cargar el controlador si no estamos en login
require_once("controlador/index.php");

if (isset($_REQUEST['m'])) {
    $metodo = $_REQUEST['m'];
    if (method_exists("modeloController", $metodo)) {
        modeloController::{$metodo}();
    } else {
        modeloController::index();
    }
} else {
    modeloController::index();
}
?>
