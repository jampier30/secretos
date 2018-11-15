<?php
class Proceso_Fuentes{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function crearFuentes($DescFuenteAbastecimmiento){	
		$sql="INSERT INTO fuenteabastecimmiento (DescFuenteAbastecimmiento) VALUES ('".$DescFuenteAbastecimmiento."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizarFuentes($idFuenteAbastecimmiento,$DescFuenteAbastecimmiento){
		$sql="UPDATE fuenteabastecimmiento SET DescFuenteAbastecimmiento='".$DescFuenteAbastecimmiento."' WHERE idFuenteAbastecimmiento=".$idFuenteAbastecimmiento;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listaFuentes(){
		$sql="SELECT * FROM fuenteabastecimmiento";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarFuentes($idFuenteAbastecimmiento){
		$sql="SELECT * FROM fuenteabastecimmiento WHERE idFuenteAbastecimmiento=".$idFuenteAbastecimmiento;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>