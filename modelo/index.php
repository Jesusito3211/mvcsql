<?php
class Modelo {
    protected $db;
    private $personas;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=mvc", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->personas = array();
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function insertar($tabla, $data) {
        $consulta = "INSERT INTO $tabla VALUES (NULL, $data)";
        $resultado = $this->db->query($consulta);
        return $resultado ? true : false;
    }

    public function mostrar($tabla, $condicion) {
        $consulta = "SELECT * FROM $tabla WHERE $condicion";
        $resultado = $this->db->query($consulta);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($tabla, $data, $condicion) {
        $consulta = "UPDATE $tabla SET $data WHERE $condicion";
        $resultado = $this->db->query($consulta);
        return $resultado ? true : false;
    }

    public function eliminar($tabla, $condicion) {
        $consulta = "DELETE FROM $tabla WHERE $condicion";
        $resultado = $this->db->query($consulta);
        return $resultado ? true : false;
    }
}
?>