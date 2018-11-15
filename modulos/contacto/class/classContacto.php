<?php
class Proceso_Contacto{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	
	function insertarContacto($Nombre,$idClasificacion,$CargoContacto,$TelefonoContacto,$CelularContacto,$emailContacto,$idRegion,$idDepartamento,$idTipoMunicipio){	
		$sql="INSERT INTO contacto (Nombre,idClasificacion,CargoContacto,TelefonoContacto,CelularContacto,emailContacto,idRegion,idDepartamento,idTipoMunicipio) VALUES ('".$Nombre."',".$idClasificacion.",'".$CargoContacto."','".$TelefonoContacto."','".$CelularContacto."','".$emailContacto."',".$idRegion.",".$idDepartamento.",".$idTipoMunicipio.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizarContacto($idContactoFM,$NombreFM,$idClasificacionFM,$CargoContactoFM,$TelefonoContactoFM,$CelularContactoFM,$emailContactoFM,$idRegionFM,$idDepartamentoFM,$idTipoMunicipioFM){
		$sql="UPDATE contacto SET 
		idContacto=".$idContactoFM.",
		Nombre='".$NombreFM."',
		idClasificacion=".$idClasificacionFM.",
		CargoContacto='".$CargoContactoFM."',
		TelefonoContacto='".$TelefonoContactoFM."',
		CelularContacto='".$CelularContactoFM."',
		emailContacto='".$emailContactoFM."',
		idRegion=".$idRegionFM.",
		idDepartamento=".$idDepartamentoFM.",
		idTipoMunicipio=".$idTipoMunicipioFM."
		WHERE idContacto=".$idContactoFM;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listaContacto(){
		$sql="SELECT
        contacto.*,
        clasificacioncontacto.DescClasificacionC,
        region.DescRegion,
        departamento.NombreDepartamento,
        tipomunicipio.DescTipoMunicipio
        FROM contacto
        inner join clasificacioncontacto on clasificacioncontacto.IdClasificacionC=contacto.idClasificacion
        inner join region on region.idRegion=contacto.idRegion
        inner join departamento on departamento.idDepartamento=contacto.idDepartamento
        inner join tipomunicipio on tipomunicipio.idTipoMunicipio=contacto.idTipoMunicipio";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarContactoxid($idContacto){
		$sql="SELECT * FROM contacto WHERE idContacto=".$idContacto;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarEmailContacto($emailContacto){
		$sql="SELECT * FROM contacto WHERE emailContacto='".$emailContacto."'";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>