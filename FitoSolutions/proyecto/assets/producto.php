<div class="container">
    <section class="py-5 text-center">
        <h2 class="mb-2">Nuestros Productos</h2>
        <div class="row">
            <?php
            require_once "../bd.php";

            $consulta = "SELECT nombre_producto, descripcion_producto, imagen_producto FROM producto";
            $resultado = $bd->query($consulta);

            // Mostrar los productos
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-lg-4 col-sm-6 mb-4">';
                echo '<div class="card h-100">';
                echo '<div class="row g-0">';
                echo '<div class="col-md-4">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($fila['imagen_producto']) . '" class="img-fluid rounded-start" alt="Imagen del producto">';
                echo '</div>';
                echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($fila["nombre_producto"]) . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($fila["descripcion_producto"]) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            ?>
        </div>
    </section>
</div>