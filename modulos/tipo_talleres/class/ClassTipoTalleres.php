<?php 

Class Proceso_TipoTaller{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidTipoTaller(){
        $lastid=0;
        $sql="SELECT MAX(idTipoTaller) AS id FROM  tipotaller";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertTipoTaller($desTipoTall, $estadoTipoTall){
        $sql="INSERT INTO  tipotaller (DescTipoTaller, EstadoTipoTaller	) VALUES ('".$desTipoTall."','".$estadoTipoTall."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaTipoTaller(){
        $sql="SELECT * FROM  tipotaller";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarTipoTaller($desTipoTall){
        $sql="SELECT * FROM  tipotaller where DescTipoTaller ='".$desTipoTall."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscaridTipoTaller($idTipoTaller){
        $sql="SELECT * FROM  tipotaller where idTipoTaller ='".$idTipoTaller."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarTipoTaller($idTipoTaller, $desTipoTall, $estadoTipoTall){
        $sql="UPDATE  tipotaller SET DescTipoTaller = '".$desTipoTall."',
        EstadoTipoTaller = '".$estadoTipoTall."' WHERE idTipoTaller=".$idTipoTaller;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>