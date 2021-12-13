<?php

require_once "ConexionBD.php";

class Producto
{

    private $codProducto;
    private $nombreProducto;
    private $descripcionProducto;
    private $codCategoria;
    private $precio;
    private $cantidadDisponible;


    public static function buscarPorId(string $id): ?Producto
    {
        $db  = BaseDatos::getInstancia();
        // escapamos la consulta
        $id = $db->getConexion()->real_escape_string($id);

        $total = $db->consulta("SELECT * FROM productos WHERE codProducto='$id'")
            ->total();

        return ($total) ? $db->recuperar("Producto") : null;
    }

    public static function obtenerTodosProductos(): array
    {
        $db  = BaseDatos::getInstancia();

        $db->consulta("SELECT * FROM productos");

        return $db->recuperarTodos("Producto");
    }

    public static function crearNuevoProducto(string $nombre, string $descripcion, string $codCategoria, string $precio, string $cantidadDisponible): bool
    {

        if ($nombre != "" && $codCategoria != "" && $precio != "" && $cantidadDisponible != "") {
            $db  = BaseDatos::getInstancia();

            $total = $db->consulta("INSERT INTO productos (nombreProducto, descripcionProducto, codCategoria, precio, cantidadDisponible)
			VALUES ('$nombre', '$descripcion', '$codCategoria', '$precio', '$cantidadDisponible');");
            if ($total) {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function borrarProducto(string $id): bool
    {

            $db  = BaseDatos::getInstancia();

            $total = $db->consulta("DELETE FROM productos WHERE codProducto  = '$id';");
            if ($total) {
                return true;
            }
        
    }

    public function actualizar()
    {
        $db = BaseDatos::getInstancia();
        $sql = "UPDATE productos SET nombreProducto = '{$this->nombreProducto}',descripcionProducto  = '{$this->descripcionProducto}', codCategoria = '{$this->codCategoria}', precio = '{$this->precio}', cantidadDisponible = '{$this->cantidadDisponible}' WHERE codProducto='{$this->codProducto}'	;";

        $db->consulta($sql);
    }

    public function __get($key)
    {
        if (property_exists("Producto", $key)) return $this->$key;
        throw new Exception;
    }

    public function __set($key, $value) 
		{			
			switch($key):
				case "nombreProducto"    :
				case "descripcionProducto"     :
				case "codCategoria":
				case "precio" :
				case "cantidadDisponible"    : $this->$key = $value ; 
								break ;
				default: 
					throw new Exception ;
			endswitch ;
		}
}
