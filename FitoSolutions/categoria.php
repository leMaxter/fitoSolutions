<main class="contenidoPagina">
    <div class="container my-5">
        <h1 class="text-center mb-5">Nuestras Categorías</h1>

        <?php
        require_once "includes/bd.php";

        // Consulta para obtener todas las categorías
        $consulta = "SELECT id_categoria, nombre_categoria, descripcion_categoria FROM categoria";
        $resultado = $bd->query($consulta);

        // Mostrar cada categoría en una tarjeta
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="card mb-4 shadow-sm">';
            echo '<div class="row g-0">';
            // Imagen de la categoría (puedes cambiarla por una imagen real)
            echo '<div class="col-md-4">';
            echo '<img src="https://via.placeholder.com/400x300" class="img-fluid rounded-start" alt="' . htmlspecialchars($fila["nombre_categoria"]) . '">';
            echo '</div>';
            // Descripción de la categoría
            echo '<div class="col-md-8">';
            echo '<div class="card-body">';
            echo '<h2 class="card-title">' . htmlspecialchars($fila["nombre_categoria"]) . '</h2>';
            echo '<p class="card-text">' . htmlspecialchars($fila["descripcion_categoria"]) . '</p>';
            echo '<a href="productosCategoria.php?id_categoria=' . $fila['id_categoria'] . '" class="btn btn-primary">Ver productos</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</main>