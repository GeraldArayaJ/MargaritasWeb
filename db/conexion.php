<?php
$conn = new mysqli("localhost", "root", "200603", "tienda_ropa");
if ($conn->connect_error) {
die("Error de conexión");
}
?>