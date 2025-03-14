<?php
require_once "includes/bd.php";

if (isset($_POST['email_usuario']) && isset($_POST['password_usuario'])) {
    $email_usuario = filter_var($_POST['email_usuario']);
    $password_usuario = $_POST['password_usuario'];

    $consulta = $bd->prepare("SELECT * FROM usuario WHERE email_usuario = :email_usuario AND password_usuario = :password_usuario");
    $consulta->execute([':email_usuario' => $email_usuario, ':password_usuario' => $password_usuario]);

    if ($consulta->rowCount() > 0) {
        $usuario = $consulta->fetch();
        
        setcookie("usuario", $usuario['nombre_usuario'], time() + 3600);

        // Redirige dependiendo del rol del usuario
        if ($usuario['id_rol'] == 1) {
            header("refresh:1; url=admin.php");
        } elseif ($usuario['id_rol'] == 2) {
            header("refresh:1; url=index.php");
        } else {
            echo "<p style='color: red;'>Rol no reconocido. Espere unos segundos</p>";
            header("refresh:1; url=inicioSesion.php");
        }
    } else {
        echo "<p style='color: red;'>Correo o contraseña incorrectos. Espere unos segundos</p>";
        header("refresh:2; url=login.html");
    }
}

?>
