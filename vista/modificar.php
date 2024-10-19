<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Contacto</title>
    <link rel="stylesheet" href="../asset/estilos.css">
</head>
<body>
    <header>
        <h1>Modificar Contacto</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Volver a la Lista</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="center-contact-form">
            <form action=" " method="POST">
                <input type="hidden" name="action" value="modificar">
                <input type="hidden" name="idcontacto" value="">
                <input type="text" name="cedula" placeholder="Cédula" required>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="apellido" placeholder="Apellido" required>
                <input type="text" name="direccion" placeholder="Dirección" required>
                <input type="text" name="celular" placeholder="Celular" required>
                <button type="submit">Modificar</button>
            </form>
            <p>Por favor, complete el formulario con los datos del contacto a modificar.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mi Aplicativo de Contactos</p>
    </footer>
</body>
</html>

