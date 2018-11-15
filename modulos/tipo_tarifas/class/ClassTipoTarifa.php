<?php 

Class Proceso_TipoTarifa{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidTipoTarifa(){
        $lastid=0;
        $sql="SELECT MAX(idTipoTarifa) AS id FROM tipotarifa";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function Inserttipotarifa($desctipotarifa){
        $sql="INSERT INTO tipotarifa (DescTipoTarifa) VALUES ('".$desctipotarifa."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function Listatipotarifa(){
        $sql="SELECT * FROM tipotarifa";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function Buscardesctipotarifa($desctipotarifa){
        $sql="SELECT * FROM tipotarifa where DescTipoTarifa ='".$desctipotarifa."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function Buscartipotarifa($idTipoTarifa){
        $sql="SELECT * FROM tipotarifa where idTipoTarifa =".$idTipoTarifa;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function Editartipotarifa($idTipoTarifa, $descTipoTarifa){
        $sql="UPDATE tipotarifa SET DescTipoTarifa = '".$descTipoTarifa."' WHERE idTipoTarifa=".$idTipoTarifa;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>