<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "db/conexion.php";

/* ================== GUARDAR PRODUCTO ================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];
    $estado = $_POST['estado'];

    // Imagen
    $imagen = time() . "_" . $_FILES['imagen']['name'];
    $ruta = "img/productos/" . $imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

    // Insert producto
    $stmt = $conn->prepare("
        INSERT INTO productos (nombre, descripcion, precio, imagen, estado, categoria_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssdssi", $nombre, $descripcion, $precio, $imagen, $estado, $categoria);
    $stmt->execute();

    $producto_id = $conn->insert_id;

    // Guardar tallas
    if (!empty($_POST['tallas'])) {
        foreach ($_POST['tallas'] as $talla_id => $cantidad) {
            if ($cantidad !== "" && $cantidad >= 0) {
                $stmt = $conn->prepare("
                    INSERT INTO producto_tallas (producto_id, talla_id, cantidad)
                    VALUES (?, ?, ?)
                ");
                $stmt->bind_param("iii", $producto_id, $talla_id, $cantidad);
                $stmt->execute();
            }
        }
    }

    echo "<script>alert('Producto guardado correctamente');</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin | Subir Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <h1>Panel Admin</h1>
        <span>Las Margar🌸tas</span>
    </div>

    <nav class="menu">
        <a href="catalogo.php">Ver Catálogo</a>
        <a href="index.php">Salir</a>
    </nav>
</header>

<main class="catalogo">
    <h2 class="titulo-seccion">Subir nuevo producto</h2>

    <form class="form-admin" method="POST" enctype="multipart/form-data">

        <input type="text" name="nombre" placeholder="Nombre del producto" required>

        <textarea name="descripcion" placeholder="Descripción" required></textarea>

        <input type="number" name="precio" placeholder="Precio" step="0.01" required>

        <!-- CATEGORÍA -->
        <select name="categoria" required>
            <option value="">Seleccione categoría</option>
            <?php
            $cats = $conn->query("SELECT * FROM categorias WHERE estado='activo'");
            while ($cat = $cats->fetch_assoc()) {
                echo "<option value='{$cat['id']}'>{$cat['nombre']}</option>";
            }
            ?>
        </select>

        <!-- ESTADO -->
        <select name="estado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>

        <!-- TALLAS -->
        <h3>Tallas y Stock</h3>

        <?php
        $tallas = $conn->query("SELECT * FROM tallas");
        while ($t = $tallas->fetch_assoc()) {
            echo "
            <div class='talla-row'>
                <label>{$t['nombre']}</label>
                <input type='number' name='tallas[{$t['id']}]' min='0' placeholder='Cantidad'>
            </div>
            ";
        }
        ?>

        <!-- IMAGEN -->
        <input type="file" name="imagen" accept="image/*" required>

        <button type="submit">Guardar producto</button>

    </form>
</main>

</body>
</html>
