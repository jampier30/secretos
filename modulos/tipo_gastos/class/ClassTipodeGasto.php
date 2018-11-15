<?php
class Proceso_TipoGastos{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function creartipogasto($CodigoTipodeGasto,$DescTipodeGasto,$EstadoTipodeGasto){	
		$sql="INSERT INTO tipodegasto (CodigoTipodeGasto,DescTipodeGasto,EstadoTipodeGasto) VALUES ('".$CodigoTipodeGasto."','".$DescTipodeGasto."',".$EstadoTipodeGasto.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizartipodegasto($idTipodeGasto,$CodigoTipodeGasto,$DescTipodeGasto,$EstadoTipodeGasto){
		$sql="UPDATE tipodegasto SET CodigoTipodeGasto='".$CodigoTipodeGasto."',DescTipodeGasto='".$DescTipodeGasto."',EstadoTipodeGasto=".$EstadoTipodeGasto." WHERE idTipodeGasto=".$idTipodeGasto;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listatipogastos(){
		$sql="SELECT * FROM tipodegasto";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscartipogasto($CodigoTipodeGasto){
		$sql="SELECT * FROM tipodegasto WHERE CodigoTipodeGasto='".$CodigoTipodeGasto."'";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>