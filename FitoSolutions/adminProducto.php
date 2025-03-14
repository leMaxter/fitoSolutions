<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FitoSolutions - Administración</title>

    <!-- Enlaces a Bootstrap CSS para estilos predefinidos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" href="assets/css/estilo.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@1,300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fa346b274.js" crossorigin="anonymous"></script>
    <script>
        function aviso() {
            var respuesta = confirm("¿Deseas eliminar el producto?");
            return respuesta;
        }
    </script>
</head>

<body>
    <h1 class="text-center mt-4">Página de Admin</h1>
    <div class="container-fluid row">

        <form class="col-4 p-4" method="POST" action="" enctype="multipart/form-data">
            <h3>Añadir producto</h3>
            <?php
            ob_start();
            include "includes/bd.php";

            ?>
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre Producto</label>
                <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" required>
            </div>
            <div class="mb-3">
                <label for="descripcion_producto" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion_producto" id="descripcion_producto"
                    required></textarea>
            </div>
            <div class="mb-3">
                <label for="precio_producto" class="form-label">Precio</label>
                <input type="number" step="0.01" min="0" class="form-control" name="precio_producto"
                    id="precio_producto" required>
            </div>
            <div class="mb-3">
                <label for="categoriaId" class="form-label">Categoría</label>
                <select class="form-control" name="categoriaId" id="categoriaId" required>
                    <option value="">Selecciona categoría</option>
                    <?php
                    $stmt = $bd->query("SELECT id_categoria, nombre_categoria FROM categoria");
                    if ($stmt->rowCount() > 0) {
                        while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$categoria['id_categoria']}'>" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="proveedorId" class="form-label">Proveedor</label>
                <select class="form-control" name="proveedorId" id="proveedorId" required>
                    <option value="">Selecciona proveedor</option>
                    <?php
                    $stmt = $bd->query("SELECT id_proveedor, nombre_proveedor FROM proveedor");
                    if ($stmt->rowCount() > 0) {
                        while ($proveedor = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$proveedor['id_proveedor']}'>" . htmlspecialchars($proveedor['nombre_proveedor']) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="imagen_producto" class="form-label">Imagen</label>
                <input type="file" class="form-control" name="imagen_producto" id="imagen_producto">
            </div>
            <button type="submit" class="btn btn-primary" name="btnconfirmar" value="ok">Enviar</button>
        </form>

        <div class="col-8 p-4">
            <?php
            $consulta = $bd->query("SELECT id_producto, nombre_producto, descripcion_producto, precio_producto, id_categoria, id_proveedor, imagen_producto FROM producto");
            $totalProductos = $consulta->rowCount();
            ?>
            <div class="totalProductos mb-3">Productos en total: <?php echo $totalProductos; ?></div>
            <table class="tablaComun table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Imagen</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($datos = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
                        <tr>
                            <td><?= $datos->id_producto ?></td>
                            <td><?= $datos->nombre_producto ?></td>
                            <td><?= $datos->descripcion_producto ?></td>
                            <td><?= $datos->precio_producto ?></td>
                            <td><?= $datos->id_categoria ?></td>
                            <td><?= $datos->id_proveedor ?></td>
                            <td>
                                <?php
                                // Aquí está el bloque actualizado
                                if ($datos) {
                                    if ($datos->imagen_producto) {
                                        $imageData = base64_encode($datos->imagen_producto);
                                        $imgSrc = 'data:image/jpeg;base64,' . $imageData;
                                        echo "<img src='$imgSrc' alt='Imagen de producto' width='100' height='100'>";
                                    } else {
                                        echo "Sin imagen";
                                    }
                                } else {
                                    echo "Producto no encontrado";
                                }
                                ?>
                            </td>

                            <td>
                                <button class="btn btn-small btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editarModal" data-id="<?= $datos->id_producto ?>"
                                    data-nombre="<?= htmlspecialchars($datos->nombre_producto) ?>"
                                    data-descripcion="<?= htmlspecialchars($datos->descripcion_producto) ?>"
                                    data-precio="<?= htmlspecialchars($datos->precio_producto) ?>"
                                    data-categoria="<?= htmlspecialchars($datos->id_categoria) ?>"
                                    data-proveedor="<?= htmlspecialchars($datos->id_proveedor) ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-small btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#eliminarModal" data-id="<?= $datos->id_producto ?>"><i
                                        class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Editar -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Modificar producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <!-- Hidden input to store the product id -->
                            <input type="hidden" name="id" id="editar_id"
                                value="<?= isset($datos->id_producto) ? $datos->id_producto : ''; ?>">

                            <div class="mb-3">
                                <label for="nombre_producto" class="form-label">Nombre Producto</label>
                                <input type="text" class="form-control" name="nombre_producto" id="editar_nombre"
                                    value="<?= isset($datos->nombre_producto) ? htmlspecialchars($datos->nombre_producto) : ''; ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion_producto" class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion_producto" id="editar_descripcion"
                                    required><?= isset($datos->descripcion_producto) ? htmlspecialchars($datos->descripcion_producto) : ''; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="precio_producto" class="form-label">Precio</label>
                                <input type="number" step="0.01" min="0" class="form-control" name="precio_producto"
                                    id="editar_precio"
                                    value="<?= isset($datos->precio_producto) ? htmlspecialchars($datos->precio_producto) : ''; ?>"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="categoriaId" class="form-label">Categoría</label>
                                <select class="form-control" name="categoriaId" id="editar_categoria" required>
                                    <option value="">Selecciona categoría</option>
                                    <?php
                                    $stmt = $bd->query("SELECT id_categoria, nombre_categoria FROM categoria");
                                    if ($stmt->rowCount() > 0) {
                                        while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = ($categoria['id_categoria'] == $datos->id_categoria) ? 'selected' : '';
                                            echo "<option value='{$categoria['id_categoria']}' $selected>" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="proveedorId" class="form-label">Proveedor</label>
                                <select class="form-control" name="proveedorId" id="editar_proveedor" required>
                                    <option value="">Selecciona proveedor</option>
                                    <?php
                                    $stmt = $bd->query("SELECT id_proveedor, nombre_proveedor FROM proveedor");
                                    if ($stmt->rowCount() > 0) {
                                        while ($proveedor = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = ($proveedor['id_proveedor'] == $datos->id_proveedor) ? 'selected' : '';
                                            echo "<option value='{$proveedor['id_proveedor']}' $selected>" . htmlspecialchars($proveedor['nombre_proveedor']) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="imagen_producto" class="form-label">Imagen</label>
                                <input type="file" class="form-control" name="imagen_producto" id="imagen_producto">

                                <?php if (isset($datos->imagen_producto) && $datos->imagen_producto): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($datos->imagen_producto) ?>"
                                        alt="<?= htmlspecialchars($datos->nombre_producto) ?>" width="100" height="100">
                                <?php else: ?>
                                    Sin imagen
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="btnconfirmar"
                                value="ok">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Eliminar -->
        <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel">Eliminar producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="">
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este producto?
                            <input type="hidden" name="id" id="eliminar_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger" name="btneliminar" value="ok">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (!empty($_POST["btnconfirmar"]) && empty($_POST["id"])) {
            if (!empty($_POST["nombre_producto"]) && !empty($_POST["descripcion_producto"]) && !empty($_POST["precio_producto"]) && !empty($_POST["categoriaId"]) && !empty($_POST["proveedorId"])) {
                $nombreProducto = $_POST["nombre_producto"];
                $descripcionProducto = $_POST["descripcion_producto"];
                $precioProducto = $_POST["precio_producto"];
                $categoriaId = $_POST["categoriaId"];
                $proveedorId = $_POST["proveedorId"];
                $imagenProducto = null;

                if (!empty($_FILES["imagen_producto"]["tmp_name"])) {
                    $imagenProducto = file_get_contents($_FILES["imagen_producto"]["tmp_name"]);
                }

                if ($imagenProducto) {
                    $stmt = $bd->prepare("INSERT INTO producto (nombre_producto, descripcion_producto, precio_producto, id_categoria, id_proveedor, imagen_producto) VALUES (:nombre_producto, :descripcion_producto, :precio_producto, :id_categoria, :id_proveedor, :imagen_producto)");
                    $stmt->bindParam(':imagen_producto', $imagenProducto, PDO::PARAM_LOB);
                } else {
                    $stmt = $bd->prepare("INSERT INTO producto (nombre_producto, descripcion_producto, precio_producto, id_categoria, id_proveedor) VALUES (:nombre_producto, :descripcion_producto, :precio_producto, :id_categoria, :id_proveedor)");
                }

                $stmt->bindParam(':nombre_producto', $nombreProducto, PDO::PARAM_STR);
                $stmt->bindParam(':descripcion_producto', $descripcionProducto, PDO::PARAM_STR);
                $stmt->bindParam(':precio_producto', $precioProducto, PDO::PARAM_STR);
                $stmt->bindParam(':id_categoria', $categoriaId, PDO::PARAM_INT);
                $stmt->bindParam(':id_proveedor', $proveedorId, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    header("Location: adminProducto.php");
                } else {
                    echo '<div class="alert alert-danger">El producto no ha sido registrado</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Todos los campos deben de estar rellenados</div>';
            }
        }


        if (isset($_GET["editar"])) {
            $id = $_GET["editar"];
            $consulta = $bd->query("SELECT * FROM producto WHERE id_producto = $id");
            $datos = $consulta->fetch(PDO::FETCH_OBJ);
            ?>
            <form class="col-4 p-4 m-auto" method="POST" action="" enctype="multipart/form-data">
                <h3>Modificar producto</h3>
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-3">
                    <label for="nombre_producto" class="form-label">Nombre Producto</label>
                    <input type="text" class="form-control" name="nombre_producto" id="nombre_producto"
                        value="<?= htmlspecialchars($datos->nombre_producto) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion_producto" class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion_producto" id="descripcion_producto"
                        required><?= htmlspecialchars($datos->descripcion_producto) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="precio_producto" class="form-label">Precio</label>
                    <input type="number" step="0.01" min="0" class="form-control" name="precio_producto"
                        id="precio_producto" value="<?= htmlspecialchars($datos->precio_producto) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="categoriaId" class="form-label">Categoría</label>
                    <select class="form-control" name="categoriaId" id="categoriaId" required>
                        <option value="">Selecciona categoría</option>
                        <?php
                        $stmt = $bd->query("SELECT id_categoria, nombre_categoria FROM categoria");
                        if ($stmt->rowCount() > 0) {
                            while ($categoria = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($categoria['id_categoria'] == $datos->id_categoria) ? 'selected' : '';
                                echo "<option value='{$categoria['id_categoria']}' $selected>" . htmlspecialchars($categoria['nombre_categoria']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="proveedorId" class="form-label">Proveedor</label>
                    <select class="form-control" name="proveedorId" id="proveedorId" required>
                        <option value="">Selecciona proveedor</option>
                        <?php
                        $stmt = $bd->query("SELECT id_proveedor, nombre_proveedor FROM proveedor");
                        if ($stmt->rowCount() > 0) {
                            while ($proveedor = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($proveedor['id_proveedor'] == $datos->id_proveedor) ? 'selected' : '';
                                echo "<option value='{$proveedor['id_proveedor']}' $selected>" . htmlspecialchars($proveedor['nombre_proveedor']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="imagen_producto" class="form-label">Imagen</label>
                    <input type="file" class="form-control" name="imagen_producto" id="imagen_producto">
                    <?php if ($datos->imagen_producto): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($datos->imagen_producto) ?>"
                            alt="<?= htmlspecialchars($datos->nombre_producto) ?>" width="100" height="100">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary" name="btnmodificar" value="ok">Modificar</button>
            </form>
        <?php } ?>

        <?php
        if (isset($_POST["btnconfirmar"]) && $_POST["btnconfirmar"] == "ok") {
            // Recoger los datos del formulario
            $id = $_POST["id"];
            $nombreProducto = $_POST["nombre_producto"];
            $descripcionProducto = $_POST["descripcion_producto"];
            $precioProducto = $_POST["precio_producto"];
            $categoriaId = $_POST["categoriaId"];
            $proveedorId = $_POST["proveedorId"];

            // Verificar si se subió una nueva imagen
            if (isset($_FILES['imagen_producto']) && $_FILES['imagen_producto']['error'] == 0) {
                // Subir la imagen
                $imagenProducto = file_get_contents($_FILES["imagen_producto"]["tmp_name"]);

                // Consulta para actualizar todos los datos, incluida la imagen
                $consulta = "UPDATE producto SET 
                   nombre_producto = :nombre_producto,
                   descripcion_producto = :descripcion_producto, 
                   precio_producto = :precio_producto,
                   id_categoria = :id_categoria, 
                   id_proveedor = :id_proveedor,
                   imagen_producto = :imagen_producto
                   WHERE id_producto = :id_producto";
                $stmt = $bd->prepare($consulta);
                $stmt->bindParam(':imagen_producto', $imagenProducto, PDO::PARAM_LOB); // Bind para la imagen
            } else {
                // Si no se sube una nueva imagen, no actualizar el campo de imagen
                $consulta = "UPDATE producto SET 
                   nombre_producto = :nombre_producto,
                   descripcion_producto = :descripcion_producto, 
                   precio_producto = :precio_producto,
                   id_categoria = :id_categoria, 
                   id_proveedor = :id_proveedor
                   WHERE id_producto = :id_producto";
                $stmt = $bd->prepare($consulta);
            }

            // Bind de los demás parámetros
            $stmt->bindParam(':nombre_producto', $nombreProducto);
            $stmt->bindParam(':descripcion_producto', $descripcionProducto);
            $stmt->bindParam(':precio_producto', $precioProducto);
            $stmt->bindParam(':id_categoria', $categoriaId);
            $stmt->bindParam(':id_proveedor', $proveedorId);
            $stmt->bindParam(':id_producto', $id);

            // Ejecutar la consulta y verificar si fue exitosa
            if ($stmt->execute()) {
                echo "Producto modificado correctamente.";
                // Redirigir o refrescar la página, si es necesario
                header("Location: adminProducto.php"); // Redirigir a la página de productos (ajusta la URL si es necesario)
                exit();
            } else {
                echo "Error al modificar producto.";
            }
        }


        if (!empty($_POST["btneliminar"])) {
            $id = $_POST['id'];
            if (!empty($id)) {
                $stmt = $bd->prepare("DELETE FROM producto WHERE id_producto = :id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    header("Location: adminProducto.php");
                    exit; // Asegúrate de llamar exit después del redireccionamiento
                } else {
                    echo '<div>Error al borrar</div>';
                }
            } else {
                echo '<div>No se ha seleccionado laa categoría para eliminar</div>';
            }
        }

        ob_end_flush();
        ?>

        <!-- Scripts de Bootstrap y jQuery -->
        <script src="assets/js/scriptModal2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>


    </div>
</body>

</html>