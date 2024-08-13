<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sendero_millonario";

// Crear conexión
$conx = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conx->connect_error) {
    die("Connection failed: " . $conx->connect_error);
}
?>
