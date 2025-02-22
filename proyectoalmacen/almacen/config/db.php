<?php
$servername = "localhost"; // o la IP de tu servidor
$username = "root"; // tu usuario
$password = ""; // tu contraseña (en XAMPP, normalmente está vacía)
$dbname = "almacen_db"; // el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
