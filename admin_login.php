<?php
session_start();

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    // CREDENCIALES (luego se puede pasar a BD)
    if ($usuario === "admin" && $clave === "1234") {
        $_SESSION["admin"] = true;
        header("Location: subir_producto.php");
        exit;
    } else {
        $mensaje = "❌ Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="formulario">
    <h2>Acceso Administrador</h2>

    <?php if ($mensaje): ?>
        <p class="mensaje"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="clave" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>
