<?php 

Class Proceso_Area{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }


    function InserArea($DescArea, $EstadoArea){
        $sql="INSERT INTO area (DescArea, EstadoArea) VALUES ('".$DescArea."',".$EstadoArea.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaArea(){
        $sql="SELECT * FROM area";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarDepartamento($DescArea){
        $sql="SELECT * FROM area where DescArea ='".$DescArea."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarArea($idArea, $DescArea, $EstadoArea){
        $sql="UPDATE area SET DescArea = '".$DescArea."',
        EstadoArea = ".$DescArea." WHERE idArea=".$idArea;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>