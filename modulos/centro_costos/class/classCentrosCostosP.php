<?php

Class Proceso_CentroCostosP{


    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

     function ListarCentroCostosP(){
        $sql="SELECT * FROM centrodecostospadre";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarCentroCostosPxid($idCentrodeCostosPadre){
        $sql="SELECT * FROM centrodecostospadre where idCentrodeCostosPadre=".$idCentrodeCostosPadre;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarCentroCostosPxcodigo($CodCentrodeCostoPadre){
        $sql="SELECT * FROM centrodecostospadre where CodCentrodeCostoPadre='".$CodCentrodeCostoPadre."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarCentroCostosP($CodCentrodeCostoPadre,$DescCentrodeCostosPadre){
        $sql="INSERT INTO centrodecostospadre (CodCentrodeCostoPadre,DescCentrodeCostosPadre) VALUES ('".$CodCentrodeCostoPadre."', '".$DescCentrodeCostosPadre."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarCentroCostosP($idCentrodeCostosPadre,$CodCentrodeCostoPadre,$DescCentrodeCostosPadre){
        $sql="UPDATE centrodecostospadre SET CodCentrodeCostoPadre='".$CodCentrodeCostoPadre."',DescCentrodeCostosPadre='".$DescCentrodeCostosPadre."' WHERE idCentrodeCostosPadre=".$idCentrodeCostosPadre;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }
}
?>