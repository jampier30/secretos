<?php
class Proceso_Vereda{

    public function __construct($InstanciaDB)
    {
        $this->ConnxClass=$InstanciaDB;
	}
	
function listaVereda(){
		$sql="SELECT vereda.*,
        municipio.NombreMunicipio
        from vereda
        inner join municipio on vereda.Municipio_idMunicipio = municipio.idMunicipio";
		$this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
		return $this->resultado;
	}

	function getlastidVereda(){
        $sql="SELECT MAX(idVereda) AS id FROM vereda";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function Insertvereda($descVereda, $idMcpio){
        $sql="INSERT INTO vereda (NombreVereda, Municipio_idMunicipio) VALUES ('".$descVereda."','".$idMcpio."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function Buscarvereda($descVereda){
        $sql="SELECT * FROM vereda where NombreVereda ='".$descVereda."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscaridVereda($idVereda){
        $sql="SELECT * FROM vereda where idVereda ='".$idVereda."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function Editarvereda($idVereda, $descVereda, $idMcpio){
        $sql="UPDATE vereda SET idVereda = '".$idVereda."',  NombreVereda = '".$descVereda."',
        Municipio_idMunicipio = ".$idMcpio." WHERE idVereda=".$idVereda;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}