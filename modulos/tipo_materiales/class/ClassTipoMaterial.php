<?php
class Proceso_TipoMaterial{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function creartipomaterial($DecTipodeMaterial){	
		$sql="INSERT INTO tipodematerial (DecTipodeMaterial) VALUES ('".$DecTipodeMaterial."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizartipomaterial($idTipodeMaterial,$DecTipodeMaterial){
		$sql="UPDATE tipodematerial SET DecTipodeMaterial='".$DecTipodeMaterial."' WHERE idTipodeMaterial=".$idTipodeMaterial;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listatipomaterial(){
		$sql="SELECT * FROM tipodematerial";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscartipomaterial($idTipodeMaterial){
		$sql="SELECT * FROM tipodematerial WHERE idTipodeMaterial=".$idTipodeMaterial;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>