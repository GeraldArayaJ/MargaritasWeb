<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | Las Margar🌸tas</title>
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
            <h2>Eco-Friendly</h2>
            <span>Catálogo de Ropa</span>
        </div>
    </div>

    <nav class="menu">
        <a href="index.php">Inicio</a>
        <a href="index.php#catalogo">Catálogo</a>
        <a href="contacto.php" class="activo">Contacto</a>
    </nav>
</header>

<!-- ================= CONTACTO ================= -->
<main class="contacto">
    <h2 class="titulo-seccion">Contacto</h2>

    <div class="contacto-contenedor">

        <!-- INFO -->
        <div class="contacto-info">
            <h3>Hablemos 🌿</h3>
            <p>¿Tenés alguna consulta o querés más información sobre nuestros diseños?</p>

            <p><i class="fas fa-envelope"></i> annysstore30@gmail.com</p>
            <p><i class="fab fa-whatsapp"></i> +506 8980 8750</p>

            <div class="redes">
                <a href="https://www.instagram.com/las_margaritas_eco_friendly" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/share/17vQN6qgKi/" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
        </div>

        <!-- FORMULARIO -->
        <div class="contacto-form">
            <form>
                <input type="text" placeholder="Nombre completo" required>
                <input type="email" placeholder="Correo electrónico" required>
                <textarea placeholder="Escribí tu mensaje..." required></textarea>

                <button type="submit">Enviar mensaje</button>
            </form>
        </div>

    </div>
</main>

<!-- ================= FOOTER ================= -->
<footer class="footer">
    <div class="footer-copy">
        © <?php echo date("Y"); ?> Las Margar🌸tas Eco-Friendly. Todos los derechos reservados.
    </div>
</footer>

</body>
</html>
