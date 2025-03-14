<?php
require_once "includes/bd.php";

if (!isset($_GET['id_categoria']) || !is_numeric($_GET['id_categoria'])) {
    header("Location: index.php"); // Si no hay id valido manda a index
    exit();
}

$id_categoria = $_GET['id_categoria'];

// Obtener el nombre de la categoría
$consulta_categoria = "SELECT nombre_categoria FROM categoria WHERE id_categoria = :id_categoria";
$stmt_categoria = $bd->prepare($consulta_categoria);
$stmt_categoria->execute(['id_categoria' => $id_categoria]);
$categoria = $stmt_categoria->fetch(PDO::FETCH_ASSOC);

if (!$categoria) {
    header("Location: index.php"); // Si categpría no existe manda a index
    exit();
}

// Consulta productos de cada categoría
$consulta_productos = "SELECT p.id_producto, p.nombre_producto, p.descripcion_producto, p.precio_producto, p.imagen_producto 
                       FROM producto p 
                       WHERE p.id_categoria = :id_categoria";
$stmt_productos = $bd->prepare($consulta_productos);
$stmt_productos->execute(['id_categoria' => $id_categoria]);
$productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos de <?php echo htmlspecialchars($categoria['nombre_categoria']); ?> - FitoSolutions</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/estilos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fa346b274.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <?php require_once('header.php'); ?>
    </header>

    <main class="container my-5">
        <h1 class="text-center mb-5">Productos de <?php echo htmlspecialchars($categoria['nombre_categoria']); ?></h1>

        <div class="row">
            <?php
            if (count($productos) > 0) {
                foreach ($productos as $producto) {
                    echo '<div class="col-lg-4 col-md-6 mb-4">';
                    echo '<div class="card h-100 shadow-sm">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($producto['imagen_producto']) . '" class="card-img-top" alt="' . htmlspecialchars($producto['nombre_producto']) . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($producto['nombre_producto']) . '</h5>';
                    echo '<p class="card-text">' . substr(htmlspecialchars($producto['descripcion_producto']), 0, 100) . '...</p>';
                    echo '<p class="card-text"><strong>Precio: </strong>' . htmlspecialchars($producto['precio_producto']) . ' €</p>';
                    echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal' . $producto['id_producto'] . '">Ver detalles</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    // Modal para cada producto
                    echo '<div class="modal fade" id="productoModal' . $producto['id_producto'] . '" tabindex="-1" aria-labelledby="productoModalLabel' . $producto['id_producto'] . '" aria-hidden="true">';
                    echo '<div class="modal-dialog modal-dialog-centered">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="productoModalLabel' . $producto['id_producto'] . '">' . htmlspecialchars($producto['nombre_producto']) . '</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($producto['imagen_producto']) . '" class="img-fluid mb-3" alt="' . htmlspecialchars($producto['nombre_producto']) . '">';
                    echo '<p><strong>Descripción: </strong>' . htmlspecialchars($producto['descripcion_producto']) . '</p>';
                    echo '<p><strong>Precio: </strong>' . htmlspecialchars($producto['precio_producto']) . ' €</p>';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                    echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                    echo '<button type="button" class="btn btn-primary">Añadir al carrito</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12 text-center">';
                echo '<p class="lead">No hay productos disponibles en esta categoría.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </main>

    <footer class="mt-auto">
        <?php require_once('footer.php'); ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>