<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e9dc6e">
    <a class="navbar-brand" href="index.html">
        <img src="assets/img/fitoLogo.png" width="60" height="60" class="d-inline-block align-top" alt="fitoLogo">
    </a>
    <!-- Botón para colapsar la barra de navegación en dispositivos móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menús de la barra de navegación -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto" id="navUl">
                <li class="nav-item active">
                    <a class="nav-link" href="inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categoria.php">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="compra.html">Carrito</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_COOKIE['usuario'])) { ?>
                        <!-- Bienvenido,  ?= // htmlspecialchars($_COOKIE['usuario']) ? -->
                        <a class="nav-link text-primary" href="index.php?cierreSesion=true">Cerrar sesión</a>
                    <?php } else { ?>
                        <a class="nav-link text-primary" href="login.html">Iniciar sesión</a>
                    <?php } ?>
                </li>
            </div>
        </ul>
    </div>
</nav>