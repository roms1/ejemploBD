<?php
// cone.php
$host       = getenv("DB_HOST");
$port       = (int)(getenv("DB_PORT") ?: 4003);
$usuario    = getenv("DB_USER");
$password   = getenv("DB_PASSWORD");
$base_datos = getenv("DB_NAME");

$conexion = mysqli_init();

if (!$conexion) {
    die("Error al inicializar MySQLi.");
}

$conexion->ssl_set(NULL, NULL, NULL, NULL, NULL);

if (!$conexion->real_connect($host, $usuario, $password, $base_datos, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$conexion->set_charset("utf8mb4");
?>
