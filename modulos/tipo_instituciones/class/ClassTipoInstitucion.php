<?php 

Class Proceso_TipoInstitucion{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidTipoInstitucion(){
        $lastid=0;
        $sql="SELECT MAX(idTipoInstitucion) AS id FROM tipoinstitucion";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertTipoInstitucion($descTipoInstitucion){
        $sql="INSERT INTO tipoinstitucion (DescTipoInstitucion) VALUES ('".$descTipoInstitucion."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaTipoInstitucion(){
        $sql="SELECT * FROM tipoinstitucion";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescTipoInstitucion($descTipoInstitucion){
        $sql="SELECT * FROM tipoinstitucion where DescTipoInstitucion ='".$descTipoInstitucion."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarIdTipoInstitucion($CodTipoInstitucion){
        $sql="SELECT * FROM tipoinstitucion where idTipoInstitucion ='".$CodTipoInstitucion."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarTipoInstitucion($CodTipoInstitucion, $descTipoInstitucion){
        $sql="UPDATE tipoinstitucion SET DescTipoInstitucion = '".$descTipoInstitucion."'
        WHERE idTipoInstitucion=".$CodTipoInstitucion;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>