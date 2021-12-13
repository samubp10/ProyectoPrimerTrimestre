<?php

//Esta función, cuáles errores de PHP son notificados, en este caso,
// la constante predefinida "E_ERROR", avisa de errores fatales en tiempo de 
//ejecución 
error_reporting(E_ERROR);

//Establece el valor de la directiva de configuración dada (en este caso "display-errors")
//Está asignando que se puedan ver los errores en pantalla
ini_set("display-errors", 0);


$nombreUsuario = $_POST["NombreUsuario"] ?? "";
$contrasenia = $_POST["Contrasenia"] ?? "";

require_once "Sesion.php";

if ($nombreUsuario != "" and $contrasenia !== "") {
    $sesion = Sesion::getSesion();
    $sesion->login($nombreUsuario, $contrasenia);
    if (!$sesion->login($nombreUsuario, $contrasenia)) {
        $error = "Email o contraseña incorrecta";
    }
}



?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="EstiloLogin.css">
    <!-- Link de fontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Link de la fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>

    <div id="contenedorLogin">

        <div id="cuadroTransparente">
        </div>
        <div id="cuadroDentro">
            <h1 id="titulo">LOGIN</h1>

            <form method="post">

                <input class="campoNombreUsuario" type="text" name="NombreUsuario" placeholder=" Nombre de usuario" value="<?= $nombreUsuario ?>">
                <input class="campoContrasenia" type="password" name="Contrasenia" placeholder=" Contraseña">

                <?php if (isset($error)) { ?>

                    <p id="mensajeError"><?= $error; ?></p>

                <?php } ?>

                <!-- <a href="index.php" id="botonLogin">Iniciar sesión</a> -->
                <button id="botonLogin">Iniciar sesión</button>
                <a href="Registro.php" id="botonRegistro">Registrarse</a>
            </form>
        </div>
    </div>

</body>

</html>