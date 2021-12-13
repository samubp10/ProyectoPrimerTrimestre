<!DOCTYPE html>
<html lang="en">
<?php
session_start();



require_once "Productos.php";
require_once "Sesion.php";
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="PaginaPrincipal.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<title>Página principal</title>
</head>



<body>
	<div class="contenedor">
		<nav class="cabecera">
			<ul class="opciones">
				<li><img id="logo" src="Imagenes/Logo.png" alt=""></li>
				<?php if (!empty($_SESSION)) { ?>
					<li id="opcion1">Bienvenido <?php echo (unserialize($_SESSION["_user"])) ?></li>
				<?php } else { ?>
					<li id="opcion1"><a href="login.php">Autenticación <i class="fas fa-user-astronaut"></i></a></li>
				<?php } ?>

				<li><a href="crear.php" class="btn btn-primary">Añadir producto</a></li>

			</ul>
		</nav>
		<?php
		$contador = 0;
		$datos = Producto::obtenerTodosProductos();
		?>
		<div id="fondo">
			<div id="productos">
				<?php

				if (empty($datos)) {
				?>
					<div class="alert alert-info">
						No se han encontrado registros
					</div>
					<?php } else {
					$i = 0;
					while ($i < count($datos)) :
						$e = 0;
						echo "<div class=\"row\">";
						while (($i < count($datos))) :
					?>
							<div class="col-md-12 col-lg-4" id="producto<?= $i ?>">
								<div class="item card shadow m-2">
									<div class="poster overflow-hidden">

									</div>

									<div class="card-body">
										<div class="text-center">
											<h3><?= $datos[$i]->nombreProducto ?></h3>
											<h5><?= $datos[$i]->descripcionProducto ?></h5>
											<h6><?php printf("%.1f", $datos[$i]->precio) ?></h6>
										</div>


										<div class="row">
											<div class="col-sm-6 text-center">
												<a href="editar.php?id=<?= $datos[$i]->codProducto ?>">
													<i class="bi bi-info-square"></i> Editar
												</a>
											</div>
											<div class="col-sm-6 text-center">
												<a href="borrar.php?id=<?= $datos[$i]->codProducto ?>">
													<i class="bi bi-eraser"></i> Borrar
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

					<?php
							$i++;
							$e++;
						endwhile;
						echo "</div>";
					endwhile;
					?>


				<?php } ?>
			</div>
		</div>
</body>

</html>