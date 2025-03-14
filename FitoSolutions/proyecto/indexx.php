<?php
require_once "bd.php";

if (isset($_GET['cierreSesion'])) {
    setcookie("usuario", "", time() - 3600);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FitoSolutions - Inicio</title>

    <!-- Enlaces a Bootstrap CSS para estilos predefinidos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" href="css/estilos.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/7fa346b274.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@1,300&display=swap" rel="stylesheet">
</head>

<>
    <header>
        <!-- Barra de navegación fija en la parte superior -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e9dc6e">
            <a class="navbar-brand" href="index.html">
                <img src="img/fitoLogo.png" width="60" height="60" class="d-inline-block align-top" alt="fitoLogo">
            </a>
            <!-- Botón para colapsar la barra de navegación en dispositivos móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menús de la barra de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categoria.html">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="assets/producto.php">Productos</a>
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
                </ul>
            </div>
        </nav>
    </header>

    <!-- Sección Hero con un carrusel de Bootstrap -->
    <!---->

    <main class="contenidoPagina">
        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active c-carousel">
                    <img class="d-block w-100 c-img" src="img/olivo.jpeg" alt="First slide">
                    <div class="carousel-caption top-1 mt-5 d-none d-md-block">
                        <h3 class="mt-5 display-3 fw-bolder text-capitalize">Fertilizantes</h3>
                        <p class="fs-5 text-uppercase">La mejor forma para hacer crecer tu cosecha.</p>

                    </div>
                </div>
                <div class="carousel-item c-carousel">
                    <img class="d-block w-100 c-img" src="img/plaga.jpeg" alt="Second slide">
                    <div class="carousel-caption top-1 mt-5 d-none d-md-block">
                        <h3 class="mt-5 display-3 fw-bolder text-capitalize">Selección de semillas</h3>
                        <p class="fs-5 text-uppercase">¿Quieres darle un empujón a tu producción? Tenemos lo que
                            necesitas.</p>

                    </div>
                </div>
                <div class="carousel-item c-carousel">
                    <img class="d-block w-100 c-img" src="img/semilla.jpg" alt="Third slide">
                    <div class="carousel-caption top-1 mt-5 d-none d-md-block">
                        <h3 class="mt-5 display-3 fw-bolder text-capitalize">Herbicidas</h3>
                        <p class="fs-5 text-uppercase">Contamos con los productos para su tranquilidad.
                        </p>

                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!-- Sección de Servicios -->
        <div class="container">
            <section class="py-5 text-center">
                <h2 class="mb-2">Nuestros Servicios</h2>
                <div class="row">
                    <!-- Tarjeta de servicio 1 -->
                    <div class="col-lg-3 col-sm-6 mb-2 mt-5 d-flex">
                        <div class="card flex-fill" onclick="location.href='atencionCliente.html';">
                            <img src="img/servicio1.jpg" class="card-img-top" alt="Atención al cliente" />
                            <div class="card-body">
                                <h5 class="card-title">Atencion al cliente</h5>
                                <p class="card-text">
                                    Te ayudamos a elegir los productos recomendados según tus nececidades.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta de servicio 2 -->
                    <div class="col-lg-3 col-sm-6 mb-2 mt-5 d-flex">
                        <div class="card flex-fill" onclick="location.href='';">
                            <img src="img/servicio2.jpeg" class="card-img-top" alt="Fertilizantes" />
                            <div class="card-body">
                                <h5 class="card-title">Fertilizantes</h5>
                                <p class="card-text"> Si buscas un rápido crecimiento pero a la vez natural, nuestros
                                    fertilizantes serán de gran ayuda

                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta de servicio 3 -->
                    <div class="col-lg-3 col-sm-6 mb-2 mt-5 d-flex">
                        <div class="card flex-fill" onclick="location.href='';">
                            <img src="img/servicio3.jpg" class="card-img-top" alt="Vuelos" />
                            <div class="card-body">
                                <h5 class="card-title">Control de plagas</h5>
                                <p class="card-text">
                                    No tenga miedo a las plagas que acaben con su cosecha. En FitoSur tenemos una
                                    amplía variedad de productos para evitarlo.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Tarjeta de servicio 3 -->
                    <div class="col-lg-3 col-sm-6 mb-2 mt-5 d-flex">
                        <div class="card flex-fill" onclick="location.href='';">
                            <img src="img/servicio4.jpeg" class="card-img-top" alt="Vuelos" />
                            <div class="card-body">
                                <h5 class="card-title">Semillas</h5>
                                <p class="card-text">
                                    Queremos ofrecerle lo mejor y para ello le ofrecemos las semillas de mayor calidad,
                                    escogidas
                                    y estudiadas por nuestro equipo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>

        <!-- Sección de objetivo -->

        <div class="videoFondo">
            <video autoplay muted loop id="videoCampo">
                <source src="video/videoPrueba.mp4" type="video/mp4">
            </video>
            <section class="textoVideo">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mt-1 mb-4">
                            <h2>Nuestra Historia</h2>
                            <p>Desde 2016, nuestra empresa ha ayudado a miles de clientes cuidando cultivos. Con pasión
                                por
                                la tierra y compromiso con la calidad, hemos construido una reputación basada en la
                                confianza y
                                la excelencia.</p>
                        </div>
                        <div class="col-md-6 mt-1 mb-4">
                            <h2>Objetivos</h2>
                            <p>Nuestro objetivo es ayudar a un desarrollo sostenible de la agricultura, fomentando así
                                el
                                cuidando
                                de uno de los pilares fundamentales de la sociedad desde hace milenios. Ofrecemos una
                                amplía
                                gama de productos
                                para garantizar el mayor rendimiento posible con el precio más ajustado</p>
                        </div>
                    </div>
                </div>
            </section>
            </section>
        </div>
    </main>


    <!-- Pie de página -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <footer class="mt-auto">
        <div class="container-fluid">
            <div class="row mx-3">
                <div class="col-md-3 mt-4">
                    <h5><b>Contáctanos</b></h5>
                    <ul class="list-inline social-icons">
                        <li class=""><a href="#" class="text-white"><i class="fa-solid fa-phone"></i>
                                693680268 </a></li>
                        <li class=""><a href="https://x.com/Fito_Solutions?t=AJ6CxVa3LX8SWeFhGYw8cQ&s=09"
                                class="text-white"><i class="fa-solid fa-envelope"></i>
                                fitoSolutions@gmail.com</a></li>
                        <li class=""><a href="#" class="text-white"><i class="fa-solid fa-map-location-dot"></i>
                                Plaza Espaá 34, Écija</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mt-4">
                    <h5><b>Links rápidos</b></h5>
                    <ul class="list-inline">
                        <li class=""><a href="#" class="text-decoration-none text-white">Inicio</a></li>
                        <li class=""><a href="#" class="text-decoration-none text-white">Productos</a></li>
                        <li class=""><a href="#" class="text-decoration-none text-white">Contacto</a></li>
                    </ul>
                </div>


                <div class="col-md-6 mt-4">
                    <h5><b>Siguenos</b></h5>
                    <ul class="list-inline social-icons">
                        <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a
                                href="https://x.com/Fito_Solutions?t=AJ6CxVa3LX8SWeFhGYw8cQ&s=09" class="text-white"><i
                                    class="bi bi-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                        </li>
                    </ul>
                    <div data-mdb-input-init class="mt-3 mb-4">
                        <h5>Inscríbete a nuestras novedades</h5>
                        <input type="email" id="newlester" class="form-control" placeholder="Introduce tu correo" />
                    </div>
                </div>
            </div>
            <div class="footerB row">
                <div class="col-md-8 mt-4 mb-2">
                    <ul class="list-inline">
                        <li class="list-inline-item mx-3"><a href="#" class="text-decoration-none text-white">Politica
                                de privacidad</a></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none text-white">Política de
                                cookies</a></li>
                </div>
                <div class="col-md-4 mt-4 mb-2">
                    <p>&copy; 2025 FitoSolutions. Todos los derechos reservados.</p>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="front.js"></script>

    </body>

</html>