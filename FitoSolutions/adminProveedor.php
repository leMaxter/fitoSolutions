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
            var respuesta = confirm("¿Deseas eliminar el proveedor?");
            return respuesta;
        }
    </script>
</head>

<body>
    <h1 class="text-center mt-4">Página de Admin</h1>
    <div class="container-fluid row">

        <form class="col-4 p-4" method="POST" action="" enctype="multipart/form-data">
            <h3>Añadir proveedor</h3>
            <?php
            ob_start();
            include "includes/bd.php";

            ?>
            <div class="mb-3">
                <label for="nombre_proveedor" class="form-label">Nombre Proveedor</label>
                <input type="text" class="form-control" name="nombre_proveedor" id="nombre_proveedor" required>
            </div>
            <div class="mb-3">
                <label for="direccion_proveedor" class="form-label">Dirección proveedor</label>
                <input type="text" class="form-control" name="direccion_proveedor" id="direccion_proveedor" required>
            </div>
            <div class="mb-3">
                <label for="telefono_proveedor" class="form-label">Teléfono Proveedor</label>
                <input type="text" class="form-control" name="telefono_proveedor" id="telefono_proveedor" min="9"
                    required>
            </div>
            <div class="mb-3">
                <label for="correo_proveedor" class="form-label">Correo Proveedor</label>
                <input type="email" class="form-control" name="correo_proveedor" id="correo_proveedor" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnconfirmar" value="ok">Enviar</button>
        </form>

        <div class="col-8 p-4">
            <?php
            $consulta = $bd->query("SELECT id_proveedor, nombre_proveedor, direccion_proveedor, telefono_proveedor, correo_proveedor FROM proveedor");
            $totalProveedores = $consulta->rowCount();
            ?>
            <div class="totalProveedores mb-3">Proveedores en total: <?php echo $totalProveedores; ?></div>
            <table class="tablaComun table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($datos = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
                        <tr>
                            <td><?= $datos->id_proveedor ?></td>
                            <td><?= $datos->nombre_proveedor ?></td>
                            <td><?= $datos->direccion_proveedor ?></td>
                            <td><?= $datos->telefono_proveedor ?></td>
                            <td><?= $datos->correo_proveedor ?></td>
                            <td>
                                <button class="btn btn-small btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editarModal" data-id="<?= $datos->id_proveedor ?>"
                                    data-nombre="<?= htmlspecialchars($datos->nombre_proveedor) ?>"
                                    data-direccion="<?= htmlspecialchars($datos->direccion_proveedor) ?>"
                                    data-telefono="<?= htmlspecialchars($datos->telefono_proveedor) ?>"
                                    data-correo="<?= htmlspecialchars($datos->correo_proveedor) ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-small btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#eliminarModal" data-id="<?= $datos->id_proveedor ?>"><i
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
                        <h5 class="modal-title" id="editarModalLabel">Modificar proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editar_id">
                            <div class="mb-3">
                                <label for="nombre_proveedor" class="form-label">Nombre Proveedor</label>
                                <input type="text" class="form-control" name="nombre_proveedor" id="editar_nombre"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="direccion_proveedor" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion_proveedor" id="editar_direccion"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono_proveedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono_proveedor" id="editar_telefono"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="correo_proveedor" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="correo_proveedor" id="editar_correo"
                                    required>
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
                        <h5 class="modal-title" id="eliminarModalLabel">Eliminar proveedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="">
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este proveedor?
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
            if (!empty($_POST["nombre_proveedor"]) && !empty($_POST["direccion_proveedor"]) && !empty($_POST["telefono_proveedor"]) && !empty($_POST["correo_proveedor"])) {
                $nombreProveedor = $_POST["nombre_proveedor"];
                $direccionProveedor = $_POST["direccion_proveedor"];
                $telefonoProveedor = $_POST["telefono_proveedor"];
                $correoProveedor = $_POST["correo_proveedor"];

                $stmt = $bd->prepare("INSERT INTO proveedor (nombre_proveedor, direccion_proveedor, telefono_proveedor, correo_proveedor) VALUES (:nombre_proveedor, :direccion_proveedor, :telefono_proveedor, :correo_proveedor)");

                $stmt->bindParam(':nombre_proveedor', $nombreProveedor, PDO::PARAM_STR);
                $stmt->bindParam(':direccion_proveedor', $direccionProveedor, PDO::PARAM_STR);
                $stmt->bindParam(':telefono_proveedor', $telefonoProveedor, PDO::PARAM_STR);
                $stmt->bindParam(':correo_proveedor', $correoProveedor, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    header("Location: adminProveedor.php");
                    exit();
                } else {
                    echo '<div class="alert alert-danger">El proveedor no ha sido registrado</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Todos los campos deben de estar rellenados</div>';
            }
        }

        if (isset($_GET["editar"])) {
            $id = $_GET["editar"];
            $consulta = $bd->query("SELECT * FROM proveedor WHERE id_proveedor = $id");
            $datos = $consulta->fetch(PDO::FETCH_OBJ);
            ?>
            <form class="col-4 p-4 m-auto" method="POST" action="">
                <h3>Modificar proveedor</h3>
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-3">
                    <label for="nombre_proveedor" class="form-label">Nombre Proveedor</label>
                    <input type="text" class="form-control" name="nombre_proveedor" id="nombre_proveedor"
                        value="<?= htmlspecialchars($datos->nombre_proveedor) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="direccion_proveedor" class="form-label">Dirección proveedor</label>
                    <input type="text" class="form-control" name="direccion_proveedor" id="direccion_proveedor"
                        value="<?= htmlspecialchars($datos->direccion_proveedor) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono_proveedor" class="form-label">Teléfono Proveedor</label>
                    <input type="text" class="form-control" name="telefono_proveedor" id="telefono_proveedor" min="9"
                        value="<?= htmlspecialchars($datos->telefono_proveedor) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="correo_proveedor" class="form-label">Correo Proveedor</label>
                    <input type="email" class="form-control" name="correo_proveedor" id="correo_proveedor"
                        value="<?= htmlspecialchars($datos->correo_proveedor) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="btnconfirmar" value="ok">Modificar</button>
            </form>
        <?php } ?>

        <?php
        if (!empty($_POST["btnconfirmar"]) && !empty($_POST["id"])) {
            if (!empty($_POST["nombre_proveedor"]) && !empty($_POST["direccion_proveedor"]) && !empty($_POST["telefono_proveedor"]) && !empty($_POST["correo_proveedor"])) {
                $id = $_POST["id"];
                $nombreProveedor = $_POST["nombre_proveedor"];
                $direccionProveedor = $_POST["direccion_proveedor"];
                $telefonoProveedor = $_POST["telefono_proveedor"];
                $correoProveedor = $_POST["correo_proveedor"];

                $consulta = "UPDATE proveedor SET 
          nombre_proveedor = :nombre_proveedor,
          direccion_proveedor = :direccion_proveedor,
          telefono_proveedor = :telefono_proveedor,
          correo_proveedor = :correo_proveedor
          WHERE id_proveedor = :id_proveedor";

                $stmt = $bd->prepare($consulta);
                $stmt->bindParam(':nombre_proveedor', $nombreProveedor);
                $stmt->bindParam(':direccion_proveedor', $direccionProveedor);
                $stmt->bindParam(':telefono_proveedor', $telefonoProveedor);
                $stmt->bindParam(':correo_proveedor', $correoProveedor);
                $stmt->bindParam(':id_proveedor', $id);

                if ($stmt->execute()) {
                    header("Location: adminProveedor.php");
                    exit();
                } else {
                    echo '<div class="alert alert-danger">El proveedor no fue modificado</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Todos los campos deben de estar rellenados</div>';
            }
        }

        if (!empty($_POST["btneliminar"]) && !empty($_POST["id"])) {
            $idProveedor = $_POST["id"];
            $stmt = $bd->prepare("DELETE FROM proveedor WHERE id_proveedor = :id");
            $stmt->bindParam(':id', $idProveedor, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: adminProveedor.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Error al eliminar el proveedor.</div>';
            }
        }
        ob_end_flush();
        ?>

        <!-- Scripts de Bootstrap y jQuery -->
        <script src="assets/js/script3.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </div>
</body>

</html>