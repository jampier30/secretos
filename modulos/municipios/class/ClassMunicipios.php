<?php 

Class Proceso_Municipios{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidMunicipios(){
        $sql="SELECT MAX(idMunicipio) AS id FROM municipio";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertMunicipio($codDANEMcpio,$descMunicipio,$idRegion,$idTipoMcpio,$idTipoTarifa,$idDpto){
        $sql="INSERT INTO municipio (idDaneMunicipio, NombreMunicipio, Region_idRegion,TipoMunicipio_idTipoMunicipio,idTipoTarifa,departamento_idDepartamento) 
        VALUES ('".$codDANEMcpio."','".$descMunicipio."','".$idRegion."','".$idTipoMcpio."','".$idTipoTarifa."','".$idDpto."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaMunicipio(){


        $sql="SELECT municipio.*,
            region.DescRegion,
            tipomunicipio.DescTipoMunicipio,
            tipotarifa.DescTipoTarifa,
            departamento.NombreDepartamento
            from municipio
            inner join region on municipio.Region_idRegion=region.idRegion
            inner join tipomunicipio on municipio.TipoMunicipio_idTipoMunicipio=tipomunicipio.idTipoMunicipio
            inner join tipotarifa on municipio.idTipoTarifa=tipotarifa.idTipoTarifa
            inner join departamento on municipio.departamento_idDepartamento=departamento.idDepartamento  ";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescMunicipio($descMunicipio){
        $sql="SELECT * FROM municipio where NombreMunicipio ='".$descMunicipio."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarMunicipio($idMunicipio){
        $sql="SELECT * FROM municipio where idMunicipio =".$idMunicipio;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function BuscarCodMunicipio($idDaneMunicipio){
        $sql="SELECT * FROM municipio where idDaneMunicipio ='".$idDaneMunicipio."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarMunicipio($idMunicipio,$idDaneMunicipio,$descMunicipio,$idRegion,$idTipoMcpio,$idTipoTarifa,$idDpto){
        $sql="UPDATE municipio SET NombreMunicipio = '".$descMunicipio."',
        idDaneMunicipio = '".$idDaneMunicipio."', Region_idRegion = '".$idRegion."',
        TipoMunicipio_idTipoMunicipio = '".$idTipoMcpio."', 
        idTipoTarifa = '".$idTipoTarifa."', departamento_idDepartamento = '".$idDpto."'
        WHERE idMunicipio=".$idMunicipio;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>