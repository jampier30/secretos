<?php 

Class Proceso_Region{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidRegion(){
        $lastid=0;
        $sql="SELECT MAX(idRegion) AS id FROM region";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertRegion($idRegion, $descrRegion){
        $sql="INSERT INTO region (idRegion, DescRegion) VALUES ('".$idRegion."','".$descrRegion."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaRegion(){
        $sql="SELECT * FROM region";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescRegion($descrRegion){
        $sql="SELECT * FROM region where DescRegion ='".$descrRegion."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarIdRegion($idRegion){
        $sql="SELECT * FROM region where idRegion =".$idRegion;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function EditarRegion($idRegion, $descrRegion){
        $sql="UPDATE region SET DescRegion = '".$descrRegion."'
         WHERE idRegion=".$idRegion;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>