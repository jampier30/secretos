<?php 
  
// Clase de conexion a la base de datos
Class Conexion{

    public $link; //Variable donde tiene la instancia de conecion a la base
    private $host = "localhost"; //Host
    private $usuario = "root"; //Nombre de usuario
    private $clave = ""; //Contraseña
    private $db = "secretospc"; //Nombre de base de datos

    // Funcion Constructor
    public function __construct(){
        //Instancia donde genera la conexion a la DB
        $this->link=new mysqli($this->host,$this->usuario,$this->clave,$this->db);
        //Compara si la conecion tiene un error
        if ($this->link->connect_error) {
            die('Error de Conexión (' . $this->link->connect_errno . ')'. $this->link->connect_error);
        }else{ 
            // echo "Conexion correcta";
        }
        
        //Cierra la instancia de conexion
        $acentos = $this->link->query("SET NAMES 'utf8'");
        return $this->link;
        
        $this->link->close();
    }

    //Funcion para evitar clonar las conexiones a las bases
    private function __clone() { }

    function limpiar($tags){
		$tags = strip_tags($tags);
		return $tags;
	}

}




?>