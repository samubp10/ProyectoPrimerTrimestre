<?php

//Esta función, cuáles errores de PHP son notificados, en este caso,
// la constante predefinida "E_ERROR", avisa de errores fatales en tiempo de 
//ejecución 
error_reporting(E_ERROR);

//Establece el valor de la directiva de configuración dada (en este caso "display-errors")
//Está asignando que se puedan ver los errores en pantalla
ini_set("display-errors", 1);

//Creo la clase conexión la cuál va a tener 
class BaseDatos
{

	//Creamos un atributo estático de tipo "BaseDatos" que por defecto contiene el valor null 
	private static ?BaseDatos $instancia = null;

	//Un atributo para guardar el resultado
	private $result;

	//Un atributo para guardar la conexión de base de datos
	private $mysqli;

	//Ponemos a privado la capacidad de clonar el objeto para que no se pueda clonar
	//fuera de este documento
	private function __clone()
	{
	}

	/**
	 * Realizamos la conexión con el servidor de bases de datos
	 */
	private function __construct()
	{
		//Accedo al atributo no estático con la flecha y en él guardo la conexión 
		//a la base de datos
		$this->mysqli = new mysqli("sql313.epizy.com", "epiz_30586750", "D5NoOHX2beK", "epiz_30586750_spaceBP");

		//En el caso en el que la conexión de error, que lance una excepción 
		// y que muestre el menssaje puesto
		if ($this->mysqli->connect_errno) {
			throw new Exception("Se ha producido un error de conexión con la base de datos.");
		}

		//Pone la conexión en utf-8
		$this->mysqli->set_charset("utf8");
	}

	//--------------------------------------------Métodos---------------------------------------------------------------

	public function getConexion(): mysqli {
		return $this->mysqli;
	}

	/**
	 * Instanciamos la clase BaseDatos si no se ha hecho previamente,
	 * y devolvemos dicha instancia.
	 */
	public static function getInstancia()
	{
		//En el caso en el que la propia instancia sea nula, crea un objeto
		//El self sirve para hacer referencia a un atributo estático de la propia clase
		if (self::$instancia == null) {
			self::$instancia = new BaseDatos;
		}
		return self::$instancia;
	}

	//Método para realizar consultas, que deculve un objeto de tipo BaseDatos
	public function consulta(string $sql):BaseDatos
	{

		
		// hacemos la consulta
		$this->result = $this->mysqli->query($sql);

		//var_dump($this->mysqli->query($sql));

		return $this;
	}

	//Recuperamos el resultado metiendolo en un objeto de la clase que elijamos
	public function recuperar(string $clas = "StdClass")
	{
		return $this->result->fetch_object($clas);
	}

	//Recuperamos todos los resultados metiendolos cada uno de ellos en un 
	//objeto de la clase que elijamos y luego lo introducimos en un array
	public function recuperarTodos(string $clas = "StdClass"): array
	{

		//Creamos un array
		$datos = [];

		//Mientras el item no sea nulo
		while ($item = $this->recuperar($clas))

			//Que vaya metiendo los item en datos (el array)
			array_push($datos, $item);
		//
		return $datos;
	}

	//Esta función devuelve el número total de registros devultos de la consulta
	public function total(): ?int
	{
		return $this->result->num_rows;
	}


	/**
	 * Cerramos la conexión de la base de datos cuando el 
	 * objeto se destruye.
	 */
	public function __destruct()
	{
		$this->mysqli->close();
	}
}
