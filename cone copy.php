<?php
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "mi_base_de_datos";

// Crear conexión
$conexion = new mysqli($host, $usuario, $password, $base_datos);

// Verificación de conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
} else {
    echo "La conexion fue exitosa"; // Se agregó el punto y coma final
}

// Opcional: Configurar caracteres a UTF-8
$conexion->set_charset("utf8");
?>
