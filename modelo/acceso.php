<?php

class Acceso extends Modelo {
    public function __construct() {
        // Llama al constructor del padre (Modelo) para establecer la conexión a la BD
        parent::__construct();
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
            // 1. Verificar si el correo ya existe
            $sql_verificar = "SELECT * FROM usuarios WHERE correo = ?";
            $stmt_verificar = $this->db->prepare($sql_verificar);
            $stmt_verificar->execute([$correo]);

            if ($stmt_verificar->fetch()) {
                return "existe"; // El correo ya está registrado
            }

            // 2. Si no existe, insertar nuevo usuario
            $sql_insertar = "INSERT INTO usuarios (correo, clave) VALUES (?, MD5(?))";
            $stmt_insertar = $this->db->prepare($sql_insertar);
            $stmt_insertar->execute([$correo, $clave]);

            return "ok"; // Registro exitoso
        } catch (PDOException $e) {
            $this->registrarError("Error al registrar usuario ($correo): " . $e->getMessage());
            return "error"; // Error en el registro
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