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
                    <span>Bienvenido, Usuario</span>
                    <br> <br>
                    <a href="login.php" class="logout-button">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
    </header>

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
                    <!-- Aquí se insertarán las filas de contactos -->
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
