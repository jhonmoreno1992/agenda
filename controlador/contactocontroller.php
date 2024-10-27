<?php
include_once '../modelo/conexion.php';
include_once '../modelo/contacto.php';

class ContactoController {
    private $db;
    private $contacto;

    public function __construct() {
        $this->db = (new Conexion())->getConection();
        $this->contacto = new Contacto($this->db);
    }

    public function agregarContacto() {
        if ($_POST) {
            $this->contacto->cedula = $_POST['cedula'];
            $this->contacto->nombre = $_POST['nombre'];
            $this->contacto->apellido = $_POST['apellido'];
            $this->contacto->direccion = $_POST['direccion'];
            $this->contacto->celular = $_POST['celular'];

            if ($this->contacto->crear()) {
                echo "<script>alert('Contacto agregado exitosamente.'); window.location.href='../vista/contactos.php';</script>";
            } else {
                echo "<script>alert('Error al agregar contacto.');</script>";
            }
        }
    }

    public function modificarContacto() {
        if ($_POST) {
            $this->contacto->idcontacto = $_POST['idcontacto'];
            $this->contacto->cedula = $_POST['cedula'];
            $this->contacto->nombre = $_POST['nombre'];
            $this->contacto->apellido = $_POST['apellido'];
            $this->contacto->direccion = $_POST['direccion'];
            $this->contacto->celular = $_POST['celular'];

            // Implementa el método modificar en el modelo
            if ($this->contacto->modificar()) {
                echo "<script>alert('Contacto modificado exitosamente.'); window.location.href='../vista/contactos.php';</script>";
            } else {
                echo "<script>alert('Error al modificar contacto.');</script>";
            }
        }
    }

    public function eliminarContacto() {
        if ($_POST) {
            $this->contacto->idcontacto = $_POST['idcontacto'];

            // Implementa el método eliminar en el modelo
            if ($this->contacto->eliminar()) {
                echo "<script>alert('Contacto eliminado exitosamente.'); window.location.href='../vista/contactos.php';</script>";
            } else {
                echo "<script>alert('Error al eliminar contacto.');</script>";
            }
        }
    }

    // Controla las acciones
    public function handleRequest() {
        if ($_POST['action'] == 'agregar') {
            $this->agregarContacto();
        } elseif ($_POST['action'] == 'modificar') {
            $this->modificarContacto();
        } elseif ($_POST['action'] == 'eliminar') {
            $this->eliminarContacto();
        }
    }
}

// Ejecuta el controlador
$controller = new ContactoController();
$controller->handleRequest();
?>