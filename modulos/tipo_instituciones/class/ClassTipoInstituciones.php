<?php
class Proceso_TipoInstitucion{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function creartipoInstitucion($DescTipoInstitucion){	
		$sql="INSERT INTO tipoinstitucion (DescTipoInstitucion) VALUES ('".$DescTipoInstitucion."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizartipoInstitucion($idTipoInstitucion,$DescTipoInstitucion){
		$sql="UPDATE tipoinstitucion SET DescTipoInstitucion='".$DescTipoInstitucion."' WHERE idTipoInstitucion=".$idTipodeInstitucion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listatipoInstitucion(){
		$sql="SELECT * FROM tipoinstitucion";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscartipoInstitucion($idTipoInstitucion){
		$sql="SELECT * FROM tipoinstitucion WHERE idTipoInstitucion=".$idTipoInstitucion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>