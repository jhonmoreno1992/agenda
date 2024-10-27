<?php
include_once 'conexion.php';

class Contacto {
    private $conn;
    public $idcontacto;
    public $cedula;
    public $nombre;
    public $apellido;
    public $direccion;
    public $celular;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO contacto (cedula, nombre, apellido, direccion, celular) VALUES (:cedula, :nombre, :apellido, :direccion, :celular)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->cedula=htmlspecialchars(strip_tags($this->cedula));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        $this->celular=htmlspecialchars(strip_tags($this->celular));

        // Asignar valores
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":celular", $this->celular);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function modificar() {
        $query = "UPDATE contacto SET cedula=:cedula, nombre=:nombre, apellido=:apellido, direccion=:direccion, celular=:celular WHERE idcontacto=:idcontacto";
        $stmt = $this->conn->prepare($query);
        
        $this->cedula = htmlspecialchars(strip_tags($this->cedula));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->celular = htmlspecialchars(strip_tags($this->celular));
        $this->idcontacto = htmlspecialchars(strip_tags($this->idcontacto));

        $stmt->bindParam(":idcontacto", $this->idcontacto);
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":celular", $this->celular);
    
        return $stmt->execute();
    }
    
    public function eliminar() {
        $query = "DELETE FROM contacto WHERE idcontacto = :idcontacto";
        $stmt = $this->conn->prepare($query);
    
        // Sanitizar
        $this->idcontacto = htmlspecialchars(strip_tags($this->idcontacto));
    
        // Asignar valor
        $stmt->bindParam(":idcontacto", $this->idcontacto);
    
        return $stmt->execute();
    }
    

    // Métodos para modificar, eliminar, y obtener contactos se pueden añadir aquí.
}
?>