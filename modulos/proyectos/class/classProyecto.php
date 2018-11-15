<?php

Class Proceso_Proyecto{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

     function ListarProyecto(){
        $sql="SELECT proyecto.idProyecto,proyecto.DescProyecto,proyecto.idCentrodeCostosHijo,proyecto.idPrograma,centrodecostoshijo.CodCentrodeCostosHijo,centrodecostoshijo.DescCentrodeCostosHijo,centrodecostoshijo.idCentrodeCostosPadre,programa.CodPrograma,programa.DescPrograma,programa.EstadoPrograma
        FROM proyecto
        inner join centrodecostoshijo on proyecto.idCentrodeCostosHijo=centrodecostoshijo.idCentrodeCostosHijo
        inner join programa on proyecto.idPrograma=programa.idPrograma";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarProyectoxid($idProyecto){
        $sql="SELECT * FROM proyecto where idProyecto=".$idProyecto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarProyecto($DescProyecto,$idCentrodeCostosHijo,$idPrograma){
        $sql="INSERT INTO proyecto (DescProyecto,idCentrodeCostosHijo,idPrograma) VALUES ('".$DescProyecto."',".$idCentrodeCostosHijo.",".$idPrograma.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarProyecto($idProyecto,$DescProyecto,$idCentrodeCostosHijo,$idPrograma){
        $sql="UPDATE proyecto SET DescProyecto='".$DescProyecto."',idCentrodeCostosHijo=".$idCentrodeCostosHijo.",idPrograma=".$idPrograma." WHERE idProyecto=".$idProyecto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>