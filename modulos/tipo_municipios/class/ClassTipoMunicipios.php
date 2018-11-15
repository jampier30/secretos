<?php 

Class Proceso_TipoMunicipio{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidTipoMunicipio(){
        $lastid=0;
        $sql="SELECT MAX(idTipoMunicipio) AS id FROM tipomunicipio";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertTipoMunicipio($CodMcpio,$descTipoMcpio){
        $sql="INSERT INTO tipomunicipio (CodTipoMunicipio,DescTipoMunicipio) VALUES ('".$CodMcpio."','".$descTipoMcpio."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaTipoMunicipio(){
        $sql="SELECT * FROM tipomunicipio";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescTipoMunicipio($descTipoMcpio){
        $sql="SELECT * FROM tipomunicipio where DescTipoMunicipio ='".$descTipoMcpio."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarTipoMunicipio($idTipoMunicipio){
        $sql="SELECT * FROM tipomunicipio where idTipoMunicipio =".$idTipoMunicipio;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function BuscarxCodMunicipio($codTipoMunicipio){
        $sql="SELECT * FROM tipomunicipio where CodTipoMunicipio =".$codTipoMunicipio;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function EditarTipoMunicipio($idTipoMunicipio,$CodMcpio,$descTipoMcpio){
        $sql="UPDATE tipomunicipio SET DescTipoMunicipio = '".$descTipoMcpio."', CodTipoMunicipio='".$CodMcpio."'
        WHERE idTipoMunicipio=".$idTipoMunicipio;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}


?>