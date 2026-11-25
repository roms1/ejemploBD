<?php
session_start();
include("cone.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $password_ingresada = $_POST['password'];

    // Buscar al usuario por su nombre
    $stmt = $conexion->prepare("SELECT id, nombre, password FROM usuarios WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si el usuario existe
    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verificar si la contraseña ingresada coincide con la encriptada
        if (password_verify($password_ingresada, $usuario['password'])) {
            // Guardar datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];

            echo "<p style='color:green; text-align:center;'>¡Inicio de sesión exitoso! Bienvenido, " . htmlspecialchars($usuario['nombre']) . ".</p>";
            // Aquí puedes redirigir a otra página, por ejemplo:
            // header("Location: inicio.php");
        } else {
            echo "<p style='color:red; text-align:center;'>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>El usuario no existe.</p>";
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <!-- Vinculamos la misma hoja de estilos -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Contenedor para el logo o imagen superior -->
    <div class="banner-container">
        <img src="logo.jpeg" alt="Logo Jabones">
    </div>

    <form action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>

        <label for="nombre">Nombre de Usuario:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Ingresar</button>
        <a href="registro.php">¿No tienes cuenta? Regístrate aquí</a>
    </form>

</body>
</html>