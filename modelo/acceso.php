<?php
class Acceso {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=mvc', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->registrarError("Error de conexión: " . $e->getMessage());
            die("No se pudo conectar a la base de datos.");
        }
    }

    public function validarUsuario($correo, $clave) {
        try {
            $sql = "SELECT * FROM usuarios WHERE correo = ? AND clave = MD5(?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$correo, $clave]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->registrarError("Error al validar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function registrarUsuario($correo, $clave) {
        try {
            $sql = "INSERT INTO usuarios (correo, clave) VALUES (?, MD5(?))";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$correo, $clave]);
            return true;
        } catch (PDOException $e) {
            $this->registrarError("Error al registrar usuario ($correo): " . $e->getMessage());
            return false;
        }
    }

    // 🔹 Función para guardar errores en logs/errores.log
    private function registrarError($mensaje) {
        $rutaLog = __DIR__ . '/../logs/errores.log';
        $fecha = date('[Y-m-d H:i:s]');
        $linea = "$fecha $mensaje" . PHP_EOL;
        file_put_contents($rutaLog, $linea, FILE_APPEND);
    }
}
?>
