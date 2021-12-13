<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PaginaPrincipal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Editar</title>
</head>

<?php

//Esta función, cuáles errores de PHP son notificados, en este caso,
// la constante predefinida "E_ERROR", avisa de errores fatales en tiempo de 
//ejecución 
error_reporting(E_ERROR);

//Establece el valor de la directiva de configuración dada (en este caso "display-errors")
//Está asignando que se puedan ver los errores en pantalla
ini_set("display-errors", 1);

require_once "Productos.php";
require_once "Categorias.php";

if (!empty($_POST)) :

    $nombreProducto         = $_POST["nombreProducto"];
    $descripcionProducto        = $_POST["descripcionProducto"];
    $codCategoria  = $_POST["codCategoria"];
    $precio   = $_POST["precio"];
    $cantidadDisponible   = $_POST["cantidadDisponible"];

    // buscamos la productos
    $productos = Producto::crearNuevoProducto($nombreProducto,  $descripcionProducto, $codCategoria, $precio,$cantidadDisponible );


    header("location: main.php");
    die();

endif;

?>

<body>

    <div class="container">

        <h4>Crear productos</h4>

        <form method="post">

            <input type="hidden" name="id" value="<?= $id ?>" />

            <div class="row mt-2">
                <div class="col-sm-6">
                    <label for="tit">Nombre del producto: </label>
                    <input id="tit" class="form-control" name="nombreProducto" type="text" required />
                </div>
            </div> <!-- row -->

            <div class="row mt-2">
                <div class="col-sm-6">
                    <label for="fec">Descripcion: </label>
                    <textarea id="fec" class="form-control" name="descripcionProducto" type="textarea" required></textarea>

                </div>
            </div> <!-- row -->

            <div class="row mt-2">
                <div class="col-sm-6">
                    <label for="pun">Código categoría: </label>
                    <select id="pun" class="form-control" name="codCategoria" required>

                        <?php

                        $categorias = Categoria::obtenerTodasCategorias();

                        // mostramos la puntuación
                        for ($i = 1; $i < count($categorias); $i++) {

                        ?>
                            <option value=<?= $categorias[$i]->getcodCategoria() ?>$selected><?php echo  $i . " " .  $categorias[$i - 1]->getnombreCategoria() ?></option>

                        <?php } ?>

                    </select>
                </div>
            </div> <!-- row -->

            <div class="row mt-2">
                <div class="col-sm-6">
                    <label for="fec">Precio: </label>
                    <input id="fec" class="form-control" name="precio" type="number" required />

                </div>
            </div> <!-- row -->

            <div class="row mt-2">
                <div class="col-sm-6">
                    <label for="fec">Cantidad disponible: </label>
                    <input id="fec" class="form-control" name="cantidadDisponible" type="number" required />

                </div>
            </div> <!-- row -->


            <div class="row mt-2">
                <div class="col-sm-6">
                    <button class="btn btn-primary">Crear</button>
                    <a href="main.php" class="btn btn-danger">Cancelar</a>
                </div>
            </div> <!-- row -->

        </form>
    </div>

</body>

</html>