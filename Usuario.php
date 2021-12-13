<?php

require_once "ConexionBD.php";

class Usuario
{

	private $codUsuario;
	private $nombreUsuario;
	private $apellido1;
	private $apellido2;
	private $correoElectronico;
	private $contrasenia;
	private $fechaNacimento;
	private $pais;
	private $localidad;
	private $calle;

	public static function buscarPorNombreUsuarioYContrasenia(string $nombre, string $contrasena): ?Usuario
	{
		$db  = BaseDatos::getInstancia();
		// escapamos la consulta
		$nombre = $db->getConexion()->real_escape_string($nombre);
		$contrasena = $db->getConexion()->real_escape_string($contrasena);


		$total = $db->consulta("SELECT * FROM usuarios WHERE nombreUsuario='$nombre' AND contrasenia='$contrasena'")
			->total();

		return ($total) ? $db->recuperar("Usuario") : null;
	}

	public static function crearNuevoUsuario(string $nombre, string $email, string $contrasenia, string $apellido1,	string $apellido2,	string $fecha,	string $pais,	string $localidad,	string $calle): bool
	{

		if ($nombre != "" && $email != "" && $contrasenia != "" && $fecha != "") {
			$db  = BaseDatos::getInstancia();

			$total = $db->consulta("INSERT INTO usuarios (nombreUsuario, apellido1, apellido2, correoElectronico, contrasenia, fechaNacimento, pais, localidad, calle)
			VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$contrasenia', '$fecha', '$pais', '$localidad', '$calle');");
			if($total){
			return true;
			}
		} else {
			return false;
		}
	}

	public function getNombreUsuario(){

		return $this->nombreUsuario;
	}
}
