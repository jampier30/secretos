<?php
class Proceso_TipoNovedadesPla{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function creartipoNovedadesPlan($DescTipodeNovedadesPlan){	
		$sql="INSERT INTO tipodenovedadesplan (DescTipodeNovedadesPlan) VALUES ('".$DescTipodeNovedadesPlan."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizartipoNovedadesPlan($idTipodeNovedadesPlan,$DescTipodeNovedadesPlan){
		$sql="UPDATE tipodenovedadesplan SET DescTipodeNovedadesPlan='".$DescTipodeNovedadesPlan."' WHERE idTipodeNovedadesPlan=".$idTipodeNovedadesPlan;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listatipoNovedadesPlan(){
		$sql="SELECT * FROM tipodenovedadesplan";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscartipoNovedadesPlan($idTipodeNovedadesPlan){
		$sql="SELECT * FROM tipodenovedadesplan WHERE idTipodeNovedadesPlan=".$idTipodeNovedadesPlan;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>