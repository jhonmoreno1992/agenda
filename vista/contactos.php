<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location ../vista/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
    <link rel="stylesheet" href="../asset/estilos.css">
</head>

<body>
    <header>
        <h1>Agenda de Contactos</h1>
        <nav>
            <ul>
                <li>
                    <span>Bienvenido, Usuario<?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                    <br> <br>
                    <a href="../logout.php" class="logout-button">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
    </header>

    <?php
    // Incluir la clase de conexión
    include_once '../modelo/conexion.php';
    // Crear una instancia de la conexión
    $db = (new Conexion())->getConection();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cedula'])) {
        // Obtener la cédula desde el formulario
        $cedula = $_POST['cedula'];
        // Redirigir a la página de generación de PDF
        header("Location: generar_pdf.php?cedula=" . urlencode($cedula));
        exit();
    }
    ?>

    <main>
        <section id="center-contact-form">
            <form method="POST" action="">
                <label for="cedula">Ingrese la Cédula:</label>
                <input type="text" id="cedula" name="cedula" required>
                <button type="submit">Generar PDF</button>
            </form>
        </section>
        <br> <br>
        <section>
            <a class="success-button" href="agregar.php">Agregar Contacto</a>
        </section>
        <section id="search-section">
            <input type="text" id="search" placeholder="Buscar contacto..." onkeyup="searchContacts()">
        </section>

        <section id="contact-list">
            <h2>Lista de Contactos</h2>
            <table id="contactsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Celular</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once '../modelo/conexion.php';
                    include_once '../modelo/contacto.php';

                    $db = (new Conexion())->getConection();
                    $contacto = new Contacto($db);

                    $query = "SELECT * FROM contacto";
                    $stmt = $db->prepare($query);
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                <td>{$row['idcontacto']}</td>
                                <td>{$row['cedula']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['apellido']}</td>
                                <td>{$row['direccion']}</td>
                                <td>{$row['celular']}</td>
                                <td>
                                    <a class='update-button' href='modificar.php?idcontacto={$row['idcontacto']}'>Actualizar</a>
                                    <form action='../controlador/contactocontroller.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='idcontacto' value='{$row['idcontacto']}'>
                                        <input type='hidden' name='action' value='eliminar'>
                                        <button type='submit' class='delete-button' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este contacto?\");'>Eliminar</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mi Aplicativo de Contactos</p>
    </footer>

    <script>
        function searchContacts() {
            const input = document.getElementById('search').value.toLowerCase();
            const table = document.getElementById('contactsTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(input)) {
                        found = true;
                        break;
                    }
                }
                rows[i].style.display = found ? '' : 'none';
            }
        }
    </script>
</body>

</html>