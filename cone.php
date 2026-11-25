<?php
// cone.php
$host       = getenv("DB_HOST") ?: "serverless-eu-central-1.sysp0000.db1.skysql.com";
$port       = (int)(getenv("DB_PORT") ?: 4003);
$usuario    = getenv("DB_USER") ?: "dbpwf20185454";
$password   = getenv("DB_PASSWORD") ?: "uHe.KQjDuzSJ%M37ZHb9";
$base_datos = getenv("DB_NAME") ?: "mi_base_de_datos";

$conexion = mysqli_init();

if (!$conexion) {
    die("Error al inicializar MySQLi.");
}

// Habilitar SSL/TLS obligatorio en MariaDB Cloud Serverless
$conexion->ssl_set(NULL, NULL, NULL, NULL, NULL);

if (!$conexion->real_connect($host, $usuario, $password, $base_datos, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$conexion->set_charset("utf8mb4");
?>