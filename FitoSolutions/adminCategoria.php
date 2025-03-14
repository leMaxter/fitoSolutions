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
      var respuesta = confirm("¿Deseas eliminar la categoría?");
      return respuesta;
    }
  </script>
</head>

<body>
  <h1 class="text-center mt-4">Página de Admin</h1>
  <div class="container-fluid row">

    <form class="col-4 p-4" method="POST" action="">
      <h3>Añadir categoría</h3>
      <?php
      ob_start();
      include "includes/bd.php";
      ?>
      <div class="mb-3">
        <label for="nombre_categoria" class="form-label">Nombre Categoría</label>
        <input type="text" class="form-control" name="nombre_categoria" id="nombre_categoria" required>
      </div>
      <div class="mb-3">
        <label for="descripcion_categoria" class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion_categoria" id="descripcion_categoria" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="btnconfirmar" value="ok">Enviar</button>
    </form>

    <div class="col-8 p-4">
      <table class="tablaComun table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $consulta = $bd->query("SELECT id_categoria, nombre_categoria, descripcion_categoria FROM categoria");
          while ($datos = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
            <tr>
              <td><?= $datos->id_categoria ?></td>
              <td><?= $datos->nombre_categoria ?></td>
              <td><?= $datos->descripcion_categoria ?></td>
              <td>
                <button class="btn btn-small btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar"
                  data-id="<?= $datos->id_categoria ?>" data-nombre="<?= htmlspecialchars($datos->nombre_categoria) ?>"
                  data-descripcion="<?= htmlspecialchars($datos->descripcion_categoria) ?>">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-small btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar"
                  data-id="<?= $datos->id_categoria ?>"><i class="fa-solid fa-trash"></i></button>
              </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editarModalLabel">Modificar categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="">
            <div class="modal-body">
              <input type="hidden" name="id" id="editar_id">
              <div class="mb-3">
                <label for="nombre_categoria" class="form-label">Nombre Categoría</label>
                <input type="text" class="form-control" name="nombre_categoria" id="editar_nombre" required>
              </div>
              <div class="mb-3">
                <label for="descripcion_categoria" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion_categoria" id="editar_descripcion" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" name="btnconfirmar" value="ok">Modificar</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eliminarModalLabel">Eliminar categoría</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="">
            <div class="modal-body">
              ¿Estás seguro de que deseas eliminar esta categoría?
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
    if (!empty($_POST["nombre_categoria"]) && !empty($_POST["descripcion_categoria"])) {
      $nombreCategoria = $_POST["nombre_categoria"];
      $descripcionCategoria = $_POST["descripcion_categoria"];
      $stmt = $bd->prepare("INSERT INTO categoria (nombre_categoria, descripcion_categoria) VALUES (:nombre_categoria, :descripcion_categoria)");
      $stmt->bindParam(':nombre_categoria', $nombreCategoria, PDO::PARAM_STR);
      $stmt->bindParam(':descripcion_categoria', $descripcionCategoria, PDO::PARAM_STR);
      if ($stmt->execute()) {
        header("Location: adminCategoria.php");
      } else {
        echo '<div class="alert alert-danger">La categoría no ha sido registrada</div>';
      }
    } else {
      echo '<div class="alert alert-danger">Todos los campos deben de estar rellenados</div>';
    }
  }


  if (!empty($_POST["btnconfirmar"]) && !empty($_POST["id"])) {
    if (!empty($_POST["nombre_categoria"]) && !empty($_POST["descripcion_categoria"])) {
      $id = $_POST["id"];
      $nombreCategoria = $_POST["nombre_categoria"];
      $descripcionCategoria = $_POST["descripcion_categoria"];
      $consulta = "UPDATE categoria SET 
                nombre_categoria = :nombre_categoria,
                descripcion_categoria = :descripcion_categoria
                WHERE id_categoria = :id_categoria";
      $stmt = $bd->prepare($consulta);
      $stmt->bindParam(':nombre_categoria', $nombreCategoria);
      $stmt->bindParam(':descripcion_categoria', $descripcionCategoria);
      $stmt->bindParam(':id_categoria', $id);
      if ($stmt->execute()) {
        header("Location: adminCategoria.php");
      } else {
        echo '<div class="alert alert-danger">La categoría no fue modificada</div>';
      }
    } else {
      echo '<div class="alert alert-danger">Todos los campos deben de estar rellenados</div>';
    }
  }

if (!empty($_POST["btneliminar"])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $stmt = $bd->prepare("DELETE FROM categoria WHERE id_categoria = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            header("Location: adminCategoria.php");
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

  <script src="assets/js/scriptModal.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>