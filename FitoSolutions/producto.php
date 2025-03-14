<div class="container">
    <section class="py-5 text-center">
        <h2 class="mb-4">Nuestros Productos</h2>
        <p class="lead mb-5">Explora nuestra amplia gama de productos agrícolas. Haz clic en cualquier producto para obtener más detalles.</p>
        <div class="row">
            <?php
            require_once "includes/bd.php";

            // Consullta paara la base de datos
            $consulta = "SELECT p.id_producto, p.nombre_producto, p.descripcion_producto, p.precio_producto, p.imagen_producto, 
                                c.nombre_categoria, pr.nombre_proveedor 
                         FROM producto p
                         JOIN categoria c ON p.id_categoria = c.id_categoria
                         JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor";
            $resultado = $bd->query($consulta);

            // Selección producto
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-lg-4 col-md-6 mb-4">';
                echo '<div class="card h-100 shadow-sm">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($fila['imagen_producto']) . '" class="card-img-top" alt="' . htmlspecialchars($fila["nombre_producto"]) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($fila["nombre_producto"]) . '</h5>';
                echo '<p class="card-text">' . substr(htmlspecialchars($fila["descripcion_producto"]), 0, 100) . '...</p>';
                echo '<p class="card-text"><strong>Precio: </strong>' . htmlspecialchars($fila["precio_producto"]) . ' €</p>';
                echo '<p class="card-text"><small class="text-muted">Categoría: ' . htmlspecialchars($fila["nombre_categoria"]) . '</small></p>';
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal' . $fila['id_producto'] . '">Ver más</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Modal para los productos
                echo '<div class="modal fade" id="productoModal' . $fila['id_producto'] . '" tabindex="-1" aria-labelledby="productoModalLabel' . $fila['id_producto'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-centered">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="productoModalLabel' . $fila['id_producto'] . '">' . htmlspecialchars($fila["nombre_producto"]) . '</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($fila['imagen_producto']) . '" class="img-fluid mb-3" alt="' . htmlspecialchars($fila["nombre_producto"]) . '">';
                echo '<p><strong>Descripción: </strong>' . htmlspecialchars($fila["descripcion_producto"]) . '</p>';
                echo '<p><strong>Precio: </strong>' . htmlspecialchars($fila["precio_producto"]) . ' €</p>';
                echo '<p><strong>Categoría: </strong>' . htmlspecialchars($fila["nombre_categoria"]) . '</p>';
                echo '<p><strong>Proveedor: </strong>' . htmlspecialchars($fila["nombre_proveedor"]) . '</p>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
                echo '<button type="button" class="btn btn-primary">Añadir al carrito</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
</div>
<script src="assets/js/front.js"></script>