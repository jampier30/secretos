<?php

Class Proceso_CentroCostosH{


    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

     function ListarCentroCostosH(){
        $sql="SELECT centrodecostoshijo.idCentrodeCostosHijo, centrodecostoshijo.CodCentrodeCostosHijo,centrodecostoshijo.DescCentrodeCostosHijo,centrodecostoshijo.idCentrodeCostosPadre,centrodecostospadre.CodCentrodeCostoPadre,centrodecostospadre.DescCentrodeCostosPadre FROM centrodecostoshijo INNER JOIN centrodecostospadre ON centrodecostoshijo.idCentrodeCostosPadre=centrodecostospadre.idCentrodeCostosPadre";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarCentroCostosHxid($idCentrodeCostosHijo){
        $sql="SELECT * FROM centrodecostoshijo where idCentrodeCostosHijo=".$idCentrodeCostosHijo;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarCentroCostosHxcodigo($CodCentrodeCostosHijo){
        $sql="SELECT * FROM centrodecostoshijo where CodCentrodeCostosHijo='".$CodCentrodeCostosHijo."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarCentroCostosH($CodCentrodeCostosHijo,$Desccentrodecostoshijo,$idCentrodeCostosPadre){
        $sql="INSERT INTO centrodecostoshijo (CodCentrodeCostosHijo,Desccentrodecostoshijo,idCentrodeCostosPadre) VALUES ('".$CodCentrodeCostosHijo."', '".$Desccentrodecostoshijo."',".$idCentrodeCostosPadre.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarCentroCostosH($idCentrodeCostosHijo,$CodCentrodeCostosHijo,$Desccentrodecostoshijo,$idCentrodeCostosPadre){
        $sql="UPDATE centrodecostoshijo SET CodCentrodeCostosHijo='".$CodCentrodeCostosHijo."',Desccentrodecostoshijo='".$Desccentrodecostoshijo."',idCentrodeCostosPadre=".$idCentrodeCostosPadre." WHERE idCentrodeCostosHijo=".$idCentrodeCostosHijo;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>