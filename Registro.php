<?php

$nombreUsuario = $_POST["NombreUsuario"] ?? "";
$email = $_POST["Email"] ?? "";
$contrasenia = $_POST["Contrasenia"] ?? "";
$apellido1 = $_POST["apellido1"] ?? "";
$apellido2 = $_POST["apellido2"] ?? "";
$confirmarContrasenia = $_POST["ConfirmarContrasenia"] ?? "";
$fechaNacimiento = $_POST["fechaNacimiento"] ?? "";
$pais = $_POST["pais"] ?? "";
$localidad = $_POST["localidad"] ?? "";
$calle = $_POST["calle"] ?? "";


require_once "Usuario.php";

if ($contrasenia != "" && $contrasenia == $confirmarContrasenia) {

    $usuarioNuevo = new Usuario();

    $usuarioNuevo->crearNuevoUsuario($nombreUsuario, $email, $contrasenia, $apellido1, $apellido2, $fechaNacimiento, $pais, $localidad, $calle);
    var_dump($usuarioNuevo);
    if ($usuarioNuevo) {
        header("location: login.php");
    } else {
        $error = "No se ha podido registrar, inténtelo de nuevo";
    }
} elseif ($contrasenia != $confirmarContrasenia) {
    $error = "La contraseña y la confirmación de contraseña tienen que coincidir, por favor introdúzcalas de nuevo";
}

?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="EstiloRegistro.css">
    <!-- Link de fontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- Link de la fuente -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital@0;1&display=swap" rel="stylesheet">
</head>

<body>
    <div id="contenedorRegistro">

        <div id="cuadroTransparente">

            <div id="cuadroDentro">
                <h1 id="titulo">REGISTRO</h1>

                <form method="post">

                    <input class="campoNombreUsuario" type="text" name="NombreUsuario" placeholder=" Nombre completo" required>
                    <input class="campoEmail" type="email" name="Email" placeholder=" Email" required>
                    <input class="campoContrasenia" type="password" name="Contrasenia" placeholder=" Contraseña" required>
                    <input class="campoConfirmContrasenia" type="password" name="ConfirmarContrasenia" placeholder=" Confirmar contraseña" required>
                    <input class="campoApellido1" type="text" name="apellido1" placeholder=" Primer apellido">
                    <input class="campoApellido2" type="text" name="apellido2" placeholder=" Segundo apellido">
                    <input class="campoFechaNacimiento" type="date" name="fechaNacimiento" required>
                    <input class="campoPais" type="text" name="pais" placeholder=" Pais">
                    <input class="campoLocalidad" type="text" name="localidad" placeholder=" Localidad">
                    <input class="campoCalle" type="text" name="calle" placeholder="  Calle">
                    <button id="botonRegistro">Registrarse</button>
                    <?php if (isset($error)) { ?>

                        <p id="mensajeError"><?= $error; ?></p>

                    <?php } ?>
                </form>
            </div>
        </div>
    </div>

</body>

</html>