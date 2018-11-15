<?php
class Proceso_Dotaciones{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function crearDotaciones($DescElementosDotacion){	
		$sql="INSERT INTO elementosdotacion (DescElementosDotacion) VALUES ('".$DescElementosDotacion."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizarDotaciones($idElementosDotacion,$DescElementosDotacion){
		$sql="UPDATE elementosdotacion SET DescElementosDotacion='".$DescElementosDotacion."' WHERE idElementosDotacion=".$idElementosDotacion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listaDotaciones(){
		$sql="SELECT * FROM elementosdotacion";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarDotaciones($idElementosDotacion){
		$sql="SELECT * FROM elementosdotacion WHERE idElementosDotacion=".$idElementosDotacion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>