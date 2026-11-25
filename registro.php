<?php
include("cone.php");

// Procesar cuando el formulario se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    // Se encripta la contraseña por seguridad
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido_paterno, $apellido_materno, $password);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Registro exitoso.</p>";
    } else {
        echo "<p style='color:red;'>Error al registrar: " . $conexion->error . "</p>";
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <!-- Vinculamos el archivo CSS externo -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Contenedor para la imagen superior (cambia 'tu-imagen.jpg' por el nombre de tu archivo de imagen) -->
    <div class="banner-container">
        <img src="logo.jpeg" alt="Logo Jabones">
    </div>

    <form action="registro.php" method="POST">
        <h2>Formulario de Registro</h2>

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido_paterno">Apellido Paterno:</label><br>
        <input type="text" id="apellido_paterno" name="apellido_paterno" required><br><br>

        <label for="apellido_materno">Apellido Materno:</label><br>
        <input type="text" id="apellido_materno" name="apellido_materno" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Registrar</button>
        <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
    </form>

</body>
</html>