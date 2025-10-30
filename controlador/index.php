<?php
session_start();
require_once("modelo/index.php");
require_once("modelo/acceso.php");

class modeloController {
    private $model;
    private $acceso;

    public function __construct() {
        $this->model = new Modelo();
        $this->acceso = new Acceso();
    }

    // 🏠 Página principal (solo si está logueado)
    public static function index() {
        if (!isset($_SESSION['usuario'])) {
            header("location:index.php?m=login");
            exit;
        }

        $producto = new Modelo();
        $data = $producto->mostrar("productos", "1");
        require_once("vista/index.php");
    }

    // 🟩 Muestra formulario de login/registro
    public static function login() {
        require_once("vista/acceso.php");
    }

    // 🟢 Validar inicio de sesión
    public static function validar() {
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $acceso = new Acceso();
        $usuario = $acceso->validarUsuario($correo, $clave);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario['correo'];
            header("location:index.php");
            exit;
        } else {
            echo "<script>alert('Correo o contraseña incorrectos');window.location='index.php?m=login';</script>";
        }
    }

    // 🟣 Registrar nuevo usuario
    public static function registrar() {
        $correo = $_POST['correo'] ?? '';
        $clave = $_POST['clave'] ?? '';

        $acceso = new Acceso();
        $resultado = $acceso->registrarUsuario($correo, $clave);

        if ($resultado === true || $resultado === "ok") {
            echo "<script>alert('Usuario registrado correctamente');window.location='index.php?m=login';</script>";
        } elseif ($resultado === "existe") {
            echo "<script>alert('El correo ya está registrado');window.location='index.php?m=login';</script>";
        } else {
            echo "<script>alert('Error al registrar el usuario. Revise el log de errores.');window.location='index.php?m=login';</script>";
        }
    }

    // 🟠 Cerrar sesión
    public static function salir() {
        session_destroy();
        header("location:index.php?m=login");
        exit;
    }

    // ---------------------- CRUD DE PRODUCTOS ---------------------- //

    public static function nuevo() {
        if (!isset($_SESSION['usuario'])) { header("location:index.php?m=login"); exit; }
        require_once("vista/nuevo.php");
    }

    public static function guardar() {
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $data = "'$nombre', '$precio'";
        $producto = new Modelo();
        $producto->insertar("productos", $data);
        header("location:" . urlsite);
        exit;
    }

    public static function editar() {
        $id = $_REQUEST['id'];
        $producto = new Modelo();
        $data = $producto->mostrar("productos", "id=" . $id);
        require_once("vista/editar.php");
    }

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

    public static function eliminar() {
        $id = $_REQUEST['id'];
        $condicion = "id=$id";
        $producto = new Modelo();
        $producto->eliminar("productos", $condicion);
        header("location:" . urlsite);
        exit;
    }
}
?>
