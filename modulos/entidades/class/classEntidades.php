<?php

Class Proceso_Entidades{


    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

     function ListarEntidades(){
        $sql="SELECT * FROM entidadvinculada";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarEntidadesxid($idEntidadVinculada){
        $sql="SELECT * FROM entidadvinculada where idEntidadVinculada=".$idEntidadVinculada;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarEntidadesxnit($NitEntidadVinculada){
        $sql="SELECT * FROM entidadvinculada where NitEntidadVinculada='".$NitEntidadVinculada."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarEntidades($NitEntidadVinculada,$NombreEntidadVinculada){
        $sql="INSERT INTO entidadvinculada (NitEntidadVinculada,NombreEntidadVinculada) VALUES (".$NitEntidadVinculada.",'".$NombreEntidadVinculada."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarEntidad($idEntidadVinculada,$NitEntidadVinculada,$NombreEntidadVinculada){
        $sql="UPDATE entidadvinculada SET NitEntidadVinculada=".$NitEntidadVinculada.",NombreEntidadVinculada='".$NombreEntidadVinculada."' WHERE identidadvinculada=".$idEntidadVinculada;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>