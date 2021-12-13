<?php

require_once "ConexionBD.php";

class Categoria
{

    private $codCategoria ;
    private $nombreCategoria;
    private $descripcion;

    public static function buscarPorNombreCategoria(string $nombre): ?Producto
    {
        $db  = BaseDatos::getInstancia();
        // escapamos la consulta
        $nombre = $db->getConexion()->real_escape_string($nombre);

        $total = $db->consulta("SELECT * FROM categorias WHERE nombreCategoria='$nombre'")
            ->total();

        return ($total) ? $db->recuperar("Categoria") : null;
    }

    public static function obtenerTodasCategorias():array
    {
        $db  = BaseDatos::getInstancia();

        $db->consulta("SELECT * FROM categorias");

        return $db->recuperarTodos("Categoria");
    }

    public function getcodCategoria() {

        return $this->codCategoria;
    }
    public function getnombreCategoria() {

        return $this->nombreCategoria;
    }

}
