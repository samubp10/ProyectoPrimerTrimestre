<?php 

require_once "Productos.php";
require_once "ConexionBD.php";

$id  = $_GET["id"];
Producto::borrarProducto($id);
header("location: main.php");
?>