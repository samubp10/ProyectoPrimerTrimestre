<?php

require_once "Usuario.php";

class Sesion
{

	private static ?Sesion $instancia = null;

	private function __clone()
	{
	}
	private function __construct()
	{
	}

	/**
	 * Instanciamos la clase Sesion si no se ha hecho previamente,
	 * y devolvemos dicha instancia.
	 */
	public static function getSesion(): Sesion
	{

		if (self::$instancia == null) {
			self::$instancia = new Sesion;
		}

		return self::$instancia;
	}

	public function login(string $nombreUsuario, string $pass): bool
	{


		$usuario = Usuario::buscarPorNombreUsuarioYContrasenia($nombreUsuario, $pass);
		$nombreUsuario = $usuario->getNombreUsuario();
		if (!is_null($usuario)) {

			session_start();
			var_dump($nombreUsuario);
			$_SESSION["_user"] = serialize($nombreUsuario);
			$_SESSION["time"]  = time();
			header("Location:main.php");
			define("MAX_TIME", 200); // Tiempo total que tendrá el usuario si esta inactivo

			// Guardamos el tiempo
			$inicio = $_SESSION["time"] ?? "";

			// Si no hay sesión iniciada o el tiempo ha expirado, la sesión termina
			if ((empty($inicio)) or (time() > $inicio + MAX_TIME)) {
				header("Location: index.php", true, 301);
			}

			// Comprobamos hay usuario logueado
			if (!isset($_SESSION["time"])) header("Location: index.php");

			// Comprobamos si la sesión ha terminado
			$inicio = $_SESSION["time"];
			if (time() > $inicio + MAX_TIME) header("Location:index.php");
			die();
		}

		return false;
	}
}
