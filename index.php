<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "db/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Margar🌸tas | Catálogo de Ropa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <!-- ================= HEADER ================= -->
    <header class="header">
        <div class="logo">
            <img src="img/margarita.png" alt="Logo Las Margaritas" class="logo-img">
            <div class="logo-texto">
                <h1>Las Margar🌸tas</h1>
                <h2>Eco-Friendly <img src="img/leaf.png" alt="Eco friendly" class="leaf-icon"></h2>
                <span>Catálogo de Ropa</span>
            </div>
        </div>


        <nav class="menu">
            <a href="#">Inicio</a>
            <a href="catalogo.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

    <!-- ================= HERO ================= -->
    <section class="hero">
        <div class="hero-texto">
            <h2>Diseños únicos para cada ocasión</h2>
            <p>Explorá nuestra colección y descubrí piezas exclusivas.</p>
        </div>
    </section>

    <!-- ================= CATÁLOGO ================= -->
    <main class="catalogo">
        <h2 class="titulo-seccion">Nuestros Diseños</h2>

        <div class="contenedor-productos">
            <?php
            $result = $conn->query("SELECT * FROM productos WHERE estado='activo' ORDER BY id DESC");

            if ($result->num_rows == 0) {
                echo "<p class='mensaje'>No hay productos disponibles</p>";
            }

            while ($row = $result->fetch_assoc()) {

    // Buscar tallas disponibles del producto
    $tallas = $conn->query("
        SELECT t.nombre, pt.cantidad
        FROM producto_tallas pt
        JOIN tallas t ON pt.talla_id = t.id
        WHERE pt.producto_id = {$row['id']} AND pt.cantidad > 0
    ");

    $agotado = $tallas->num_rows == 0;

    echo "
    <div class='card'>
        <img src='img/productos/{$row['imagen']}' alt='{$row['nombre']}'>

        <div class='card-body'>
            <h3>{$row['nombre']}</h3>
            <p>{$row['descripcion']}</p>
    ";

    if ($agotado) {
        echo "<span class='agotado'>Agotado</span>";
    } else {

        echo "<span class='precio'>₡{$row['precio']}</span>";

        echo "<p class='tallas'><strong>Tallas:</strong><br>";

        while($t = $tallas->fetch_assoc()){
            echo "<span class='badge'>{$t['nombre']}</span> ";
        }

        echo "</p>";
    }

    echo "
        </div>
    </div>
    ";
}

            ?>

        </div>
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="footer">
        <div class="footer-contenido">
            <div>
                <h3>Las Margar🌸tas Eco-Friendly</h3>
                <p>Catálogo digital de diseños exclusivos.</p>
            </div>

            <div>
                <h4>Contacto</h4>
                <p>Email: annysstore30@gmail.com</p>
                <p>WhatsApp: +506 8980 8750</p>
            </div>

            <div>
                <h4>Redes</h4>
                <a href="https://www.instagram.com/las_margaritas_eco_friendly" target="_blank" class="red-social">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
                <br>
                <a href="https://www.facebook.com/share/17vQN6qgKi/" target="_blank" class="red-social">
                    <i class="fab fa-facebook"></i> Facebook
                </a>


            </div>
        </div>

        <div class="footer-copy">
            © <?php echo date("Y"); ?> Las Margar🌸tas Eco-Friendly. Todos los derechos reservados.
        </div>
    </footer>

</body>

</html>