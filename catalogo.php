<?php
include("db/conexion.php");

// Obtener categorías
$categorias = $conn->query("SELECT * FROM categorias");

// Filtros
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : "";
$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : "";

// Consulta base (IMPORTANTE: WHERE 1=1 para agregar filtros)
$sql = "
SELECT p.*, c.nombre AS categoria
FROM productos p
LEFT JOIN categorias c ON p.categoria_id = c.id
WHERE 1=1
";

// Filtro búsqueda
if($buscar != ""){
    $sql .= " AND p.nombre LIKE '%$buscar%'";
}

// Filtro categoría
if($categoria_id != ""){
    $sql .= " AND p.categoria_id = '$categoria_id'";
}

// Orden al final
$sql .= " ORDER BY p.id DESC";

$productos = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Catálogo</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-light">
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
            <a href="index.php">Inicio</a>
            <a href="catalogo.php">Catálogo</a>
            <a href="contacto.php">Contacto</a>
        </nav>
    </header>

<div class="container mt-4">

<h2 class="text-center mb-4">Catálogo de Productos</h2>

<!-- BUSCADOR + FILTROS -->
<form method="GET" class="row mb-4">

<div class="col-md-5">
<input type="text" name="buscar" class="form-control"
placeholder="Buscar producto..." value="<?= $buscar ?>">
</div>

<div class="col-md-4">
<select name="categoria" class="form-select">
<option value="">Todas las categorías</option>

<?php while($cat = $categorias->fetch_assoc()): ?>
<option value="<?= $cat['id'] ?>" <?= ($categoria_id == $cat['id']) ? "selected" : "" ?>>
<?= $cat['nombre'] ?>
</option>
<?php endwhile; ?>

</select>
</div>

<div class="col-md-3">
<button class="btn btn-primary w-100">Buscar</button>
</div>

</form>

<!-- PRODUCTOS -->
<div class="row">

<?php if($productos->num_rows > 0): ?>
<?php while($p = $productos->fetch_assoc()): ?>

<div class="col-md-4 mb-4">
<div class="card shadow-sm h-100">

<img src="img/productos/<?= $p['imagen'] ?>" 
class="card-img-top"
style="height:250px; object-fit:contain;">

<div class="card-body">

<h5 class="card-title"><?= $p['nombre'] ?></h5>

<p class="text-muted mb-1">
Categoría: <?= $p['categoria'] ?? "Sin categoría" ?>
</p>

<p class="mb-1">
<strong>Tallas disponibles:</strong><br>

<?php
$tallas = $conn->query("
SELECT t.nombre, pt.cantidad
FROM producto_tallas pt
JOIN tallas t ON pt.talla_id = t.id
WHERE pt.producto_id = {$p['id']} AND pt.cantidad > 0
");

if($tallas->num_rows > 0){
    while($t = $tallas->fetch_assoc()){
        echo "<span class='badge bg-dark me-1'>{$t['nombre']} ({$t['cantidad']})</span>";
    }
}else{
    echo "Sin tallas";
}
?>
</p>



<p class="mb-1">
Stock: <?= $p['cantidad'] ?>
</p>

<h4 class="text-success">₡<?= number_format($p['precio'],2) ?></h4>

<?php if($p['estado'] == "activo"): ?>
<span class="badge bg-success">Disponible</span>
<?php else: ?>
<span class="badge bg-danger">Agotado</span>
<?php endif; ?>

</div>
</div>
</div>

<?php endwhile; ?>

<?php else: ?>
<p class="text-center">No hay productos.</p>
<?php endif; ?>

</div>
</div>
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
