<?php 

Class Proceso_Actividad{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidActividades(){
        $lastid=0;
        $sql="SELECT MAX(idActividad) AS id FROM actividad";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertActividad($descActividad, $UndTiempAct){
        $sql="INSERT INTO actividad (DescripcionActividad, UnidaddeTiempoActividad) VALUES ('".$descActividad."','".$UndTiempAct."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaActividad(){
        $sql="SELECT * FROM actividad";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescActividad($descActividad){
        $sql="SELECT * FROM actividad where DescripcionActividad ='".$descActividad."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarActividad($idActividad){
        $sql="SELECT * FROM actividad where idActividad =".$idActividad;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function BuscarCodigoActividad($CodigoActividad){
        $sql="SELECT * FROM actividad where idActividad ='".$CodigoActividad."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarActividad($idActividad, $descActividad, $UndTiempAct){
        $sql="UPDATE actividad SET DescripcionActividad = '".$descActividad."',
        UnidaddeTiempoActividad = '".$UndTiempAct."' WHERE idActividad=".$idActividad;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>