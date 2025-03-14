<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitoSolutions - Admin</title>

  <!-- Enlaces a Bootstrap CSS para estilos predefinidos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Enlace al archivo CSS personalizado -->
  <link rel="stylesheet" href="assets/css/admin.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@1,300&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=close" />
  <script src="https://kit.fontawesome.com/7fa346b274.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="wrapper">
    <aside id="sidebar">
      <div class="d-flex">
        <button class="toggle-btn" type="button">
          <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
          <a href="">FitoSolutions</a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link" data-content="perfil.php">
            <i class="fa-solid fa-user"></i>
            <span>Perfil</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="adminProducto.php" class="sidebar-link">
            <i class="fa-solid fa-wheat-awn"></i>
            <span>Productos</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="adminProveedor.php" class="sidebar-link">
            <i class="fa-solid fa-building-wheat"></i>
            <span>Proveedores</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="adminCategoria.php" class="sidebar-link" data-content="adminCategoria.php">
            <i class="fa-solid fa-table-list"></i>
            <span>Categorias</span>
          </a>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="fa-regular fa-clock"></i>
            <span>Pendiente</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="index.php" class="sidebar-link">
            <i class="fa-solid fa-store"></i>
            <span>Modo Cliente</span>  
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Logout</span> 
        </a>
      </div>
    </aside>




    <div class="main">
      <nav class="navbar navbar-expand px-4 py-3">
        <form action="#" class="d-none d-sm-inline-block">

        </form>
        <div class="navbar-collapse collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                <img src="../proyecto/img/betis.png" class="avatar img-fluid" alt="imagenUsuario">
              </a>
              <div class="dropdown-menu dropdown-menu-end rounded">

              </div>
            </li>
          </ul>
        </div>
      </nav>

<div class="container-fluid">
      <main class="content px-3 py-4">
        
          
        </div>
      </main>


      <footer class="footer">
        <div class="container-fluid">
          <div class="row text-body-secondary">
            <div class="col-6 text-start ">
              <a class="text-body-secondary" href=" #">
                <strong>FitoSolutions</strong>
              </a>
            </div>
            <div class="col-6 text-end text-body-secondary d-none d-md-block">
              <ul class="list-inline mb-0">
                <li class="list-inline-item">
                  <a class="text-body-secondary" href="#">Contacto</a>
                </li>
                <li class="list-inline-item">
                  <a class="text-body-secondary" href="#">Sobre nosotros</a>
                </li>
                <li class="list-inline-item">
                  <a class="text-body-secondary" href="#">Terminos y condiciones</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="assets/js/frontAdmin.js"></script>
</body>

</html>


</body>

<!-- Scripts de Bootstrap y jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>