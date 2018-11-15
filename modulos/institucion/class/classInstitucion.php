<?php
class Proceso_Institucion{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
    }

	function InsertarInstitucion($CodDaneInstitucion,$NombreInstitucion,$idTipoInstitucion,$idVereda){	
		$sql="INSERT INTO Institucion (CodDaneInstitucion,NombreInstitucion,idTipoInstitucion,idVereda) 
		VALUES (".$CodDaneInstitucion.",'".$NombreInstitucion."',".$idTipoInstitucion.",".$idVereda.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
	}
	
	function actualizarInstitucion($idInstitucion,$CodDaneInstitucion,$NombreInstitucion,$idTipoInstitucion,$idVereda){
		$sql="UPDATE Institucion SET 
		idInstitucion=".$idInstitucion.",
		CodDaneInstitucion=".$CodDaneInstitucion.",
		NombreInstitucion='".$NombreInstitucion."',
		idTipoInstitucion=".$idTipoInstitucion.",
		idVereda=".$idVereda." 
		WHERE idInstitucion=".$idInstitucion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;		
	}

	function listaInstitucion(){
		$sql="SELECT
			institucion.*,
			tipoinstitucion.DescTipoInstitucion,
			vereda.NombreVereda,
			municipio.NombreMunicipio
			FROM institucion
			INNER JOIN tipoinstitucion ON institucion.idTipoInstitucion=tipoinstitucion.idTipoInstitucion
			INNER JOIN vereda ON vereda.idVereda=institucion.idVereda
			INNER JOIN municipio ON  municipio.idMunicipio=vereda.Municipio_idMunicipio";

		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarInstitucion($idInstitucion){
		$sql="SELECT * FROM institucion WHERE idInstitucion=".$idInstitucion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function buscarInstitucionxDANE($CodDaneInstitucion){
		$sql="SELECT * FROM institucion WHERE CodDaneInstitucion=".$CodDaneInstitucion;
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}
}
?>