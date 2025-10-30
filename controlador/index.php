<?php
session_start();

// Si no hay sesión y no se está accediendo a login/validar/registrar → redirigir
if (
    !isset($_SESSION['usuario']) &&
    (!isset($_GET['m']) || !in_array($_GET['m'], ['login', 'validar', 'registrar']))
) {
    header("location:index.php?m=login");
    exit;
}

require_once("modelo/index.php");
require_once("modelo/acceso.php");

class modeloController {
    private $model;

    public function __construct() {
        $this->model = new Modelo();
    }

    // 🟢 LISTAR PRODUCTOS
    public static function index() {
        $producto = new Modelo();
        $data = $producto->mostrar("productos", "1");
        require_once("vista/index.php");
    }

    // 🟢 NUEVO PRODUCTO
    public static function nuevo() {
        require_once("vista/nuevo.php");
    }

    // 🟢 GUARDAR PRODUCTO
    public static function guardar() {
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $data = "'$nombre', '$precio'";
        $producto = new Modelo();
        $producto->insertar("productos", $data);
        header("location:" . urlsite);
        exit;
    }

    // 🟢 EDITAR PRODUCTO
    public static function editar() {
        $id = $_REQUEST['id'];
        $producto = new Modelo();
        $data = $producto->mostrar("productos", "id=" . $id);
        require_once("vista/editar.php");
    }

    // 🟢 ACTUALIZAR PRODUCTO
    public static function update() {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $data = "nombre='$nombre', precio='$precio'";
        $condicion = "id=$id";
        $producto = new Modelo();
        $producto->actualizar("productos", $data, $condicion);
        header("location:" . urlsite);
        exit;
    }

    // 🟢 ELIMINAR PRODUCTO
    public static function eliminar() {
        $id = $_REQUEST['id'];
        $condicion = "id=$id";
        $producto = new Modelo();
        $producto->eliminar("productos", $condicion);
        header("location:" . urlsite);
        exit;
    }

    // =====================================================
    // 🟣 === LOGIN / REGISTRO / SALIR DE USUARIOS ===
    // =====================================================

    // Mostrar formulario de login/registro
    public static function login() {
        require_once("vista/acceso.php");
    }

    // Validar usuario
    public static function validar() {
        $acceso = new Acceso();
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $usuario = $acceso->validarUsuario($correo, $clave);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario['correo'];
            echo "<script>alert('Bienvenido {$usuario['correo']}'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Correo o contraseña incorrectos'); window.location='index.php?m=login';</script>";
        }
    }

    // Registrar nuevo usuario
    public static function registrar() {
        $acceso = new Acceso();
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $resultado = $acceso->registrarUsuario($correo, $clave);

        if ($resultado == "ok") {
            echo "<script>alert('Usuario registrado correctamente'); window.location='index.php?m=login';</script>";
        } elseif ($resultado == "existe") {
            echo "<script>alert('El correo ya existe'); window.location='index.php?m=login';</script>";
        } else {
            echo "<script>alert('Error al registrar usuario'); window.location='index.php?m=login';</script>";
        }
    }

    // Cerrar sesión
    public static function salir() {
        session_destroy();
        header("location:index.php?m=login");
        exit;
    }
}
?>
