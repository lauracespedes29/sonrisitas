<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA DE ADMINISTRACION DE TU SONRISA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/smileapp/css/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="/smileapp/css/style.css">
    <link rel="stylesheet" type="text/css" href="/smileapp/css/fontawesome-free-6.6.0-web/css/all.min.css">
</head>
<?php
session_start();
if (isset($_SESSION['us_tipo'])) {
    header('Location: /smileapp/vista/mostrarUsuarios.php');
    exit();
}
?>
<body>
    <img class="wave" src="/smileapp/img/wave.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="/smileapp/img/bg.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="/smileapp/controlador/loginController.php" method="post">
                <img class="logo" src="/smileapp/img/logo.png" alt="">
                <h2>SMILEAPP</h2>
                <h3>INGRESAR</h3>
                <div class="input-div ci">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>CI</h5>
                        <input type="text" name="user" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="pass" class="input" required>
                    </div>
                </div>
                <a href="nuevoUsuario.php">Registrar</a>
                <input type="submit" class="btn" value="Iniciar Sesion">
                <a href="">Desarrollado por Alaugon</a>
            </form>
        </div>
    </div>
</body>
<script src="/smileapp/js/login.js"></script>
</html>
