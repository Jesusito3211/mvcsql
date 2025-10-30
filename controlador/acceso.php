<?php
class Acceso {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // ✅ Función para validar el login
    public function validarUsuario($correo, $clave) {
        $sql = "SELECT * FROM usuarios WHERE correo = ? AND clave = MD5(?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo, $clave]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Nueva función para registrar usuario
    public function registrarUsuario($correo, $clave) {
        // Verificar si ya existe el correo
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$correo]);

        if ($stmt->fetch()) {
            // El correo ya existe
            return "existe";
        }

        // Insertar nuevo usuario
        $sql = "INSERT INTO usuarios (correo, clave) VALUES (?, MD5(?))";
        $stmt = $this->db->prepare($sql);

        if ($stmt->execute([$correo, $clave])) {
            return "ok";
        } else {
            return "error";
        }
    }
}
?>
