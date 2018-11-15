<?php 

Class Proceso_TipoEncInfr{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidTipoEncInf(){
        $lastid=0;
        $sql="SELECT MAX(idTipoMaterialEncuetaInfraestr) AS id FROM  tipomaterialencuetainfraestr";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertTipoEncInfraes($descTipoEncInfr){
        $sql="INSERT INTO  tipomaterialencuetainfraestr (DescTipoMaterialEncuetaInfraestr) VALUES ('".$descTipoEncInfr."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaTipoEncInfraes(){
        $sql="SELECT * FROM  tipomaterialencuetainfraestr";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescTipoEncInfraes($descTipoEncInfr){
        $sql="SELECT * FROM  tipomaterialencuetainfraestr where DescTipoMaterialEncuetaInfraestr ='".$descTipoEncInfr."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarTipoEncInfraes($idTipoEncInf){
        $sql="SELECT * FROM  tipomaterialencuetainfraestr where idTipoMaterialEncuetaInfraestr =".$idTipoEncInf;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function EditarTipoEncInfraes($idTipoEncInf, $descTipoEncInfr){
        $sql="UPDATE tipomaterialencuetainfraestr SET DescTipoMaterialEncuetaInfraestr = '".$descTipoEncInfr."'
        WHERE idTipoMaterialEncuetaInfraestr=".$idTipoEncInf;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>