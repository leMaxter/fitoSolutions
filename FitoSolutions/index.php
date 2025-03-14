<?php
require_once "includes/bd.php";

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
    <link rel="stylesheet" href="assets/css/estilos.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/7fa346b274.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@1,300&display=swap" rel="stylesheet">
</head>


    <header>
        <?php
       require_once('header.php')
       ?>
    </header>

    <!-- Sección Hero con un carrusel de Bootstrap -->
    <!---->

    <main class="contenidoPagina">
        
    </main>


    <!-- Pie de página -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <footer class="mt-auto">
    <?php
       require_once('footer.php')
       ?>
    </footer>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="assets/js/front.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    </body>

</html>