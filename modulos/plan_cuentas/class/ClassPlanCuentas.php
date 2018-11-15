<?php

Class Proceso_PlanCuentas{


    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

     function ListarPlanCuentas(){
        $sql="SELECT * FROM plandecuentas";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarPlanCuentasxid($idPlandeCuentas){
        $sql="SELECT * FROM plandecuentas where idPlandeCuentas=".$idPlandeCuentas;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarPlanCuentasxcodigo($CodPlandeCuentas){
        $sql="SELECT * FROM plandecuentas where CodPlandeCuentas='".$CodPlandeCuentas."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarPlanCuentas($CodPlandeCuentas,$DescPlandeCuentas,$EstadoPlandeCuentas){
        $sql="INSERT INTO plandecuentas (CodPlandeCuentas,DescPlandeCuentas,EstadoPlandeCuentas) VALUES ('".$CodPlandeCuentas."', '".$DescPlandeCuentas."',".$EstadoPlandeCuentas.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarPlanCuentas($idPlandeCuentas,$CodPlandeCuentas,$DescPlandeCuentas,$EstadoPlandeCuentas){
        $sql="UPDATE plandecuentas SET CodPlandeCuentas='".$CodPlandeCuentas."', DescPlandeCuentas='".$DescPlandeCuentas."',EstadoPlandeCuentas=".$EstadoPlandeCuentas." WHERE idPlandeCuentas=".$idPlandeCuentas;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

}
?>