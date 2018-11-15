<?php
class Proceso_ClasificacionC{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function crearClasificacionC($DescClasificacionC){	
		$sql="INSERT INTO clasificacioncontacto (DescClasificacionC) VALUES ('".$DescClasificacionC."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizarClasificacionC($IdClasificacionC,$DescClasificacionC){
		$sql="UPDATE clasificacioncontacto SET DescClasificacionC='".$DescClasificacionC."' WHERE IdClasificacionC=".$IdClasificacionC;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listaClasificacionC(){
		$sql="SELECT * FROM clasificacioncontacto";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarClasificacionC($IdClasificacionC){
		$sql="SELECT * FROM clasificacioncontacto WHERE IdClasificacionC=".$IdClasificacionC;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>