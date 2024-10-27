<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../asset/estilos.css">
</head>

<body>
    <header>
        <h1>Iniciar Sesión</h1>
    </header>

    <main>
        <section id="center-contact-form">
            <?php if (isset($_GET['error'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
            <form action="../controlador/usuarioscontroller.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mi Aplicativo de Contactos</p>
    </footer>
</body>

</html>