<?php
class Proceso_TipoNovedadesMaterial{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function creartipoNovedadesMater($DescTipoNovedadesMaterial){	
		$sql="INSERT INTO  tiponovedadesmaterial (DescTipoNovedadesMaterial) VALUES ('".$DescTipoNovedadesMaterial."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizartipoNovedadesMater($idTipoNovedadesMaterial,$DescTipoNovedadesMaterial){
		$sql="UPDATE  tiponovedadesmaterial SET DescTipoNovedadesMaterial='".$DescTipoNovedadesMaterial."' WHERE idTipoNovedadesMaterial=".$idTipoNovedadesMaterial;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listatipoNovedadesMater(){
		$sql="SELECT * FROM  tiponovedadesmaterial";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscartipoNovedadesMater($idTipoNovedadesMaterial){
		$sql="SELECT * FROM  tiponovedadesmaterial WHERE idTipoNovedadesMaterial=".$idTipoNovedadesMaterial;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarDescNovedadesMater($DescTipoNovedadesMaterial){
		$sql="SELECT * FROM  tiponovedadesmaterial WHERE DescTipoNovedadesMaterial=".$DescTipoNovedadesMaterial;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function EditarNovedadesMater($idTipoNovedadesMaterial, $DescTipoNovedadesMaterial){
        $sql="UPDATE tiponovedadesmaterial SET DescTipoNovedadesMaterial = '".$DescTipoNovedadesMaterial."'
        WHERE idTipoNovedadesMaterial=".$idTipoNovedadesMaterial;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>