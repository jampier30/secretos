<?php 

Class Proceso_Coleccion{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidColecciones(){
        $sql="SELECT MAX(idColeccion) AS id FROM coleccion";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertColecciones($DescColecciones){
        $sql="INSERT INTO coleccion (DescColeccion) VALUES ('".$DescColecciones."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaColecciones(){
        $sql="SELECT * FROM coleccion";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescColecciones($DescColecciones){
        $sql="SELECT * FROM coleccion where DescColeccion ='".$DescColecciones."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarIdColecciones($idColecciones){
        $sql="SELECT * FROM coleccion where idColeccion =".$idColecciones;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function EditarColeccion($idColecciones, $DescColecciones){
        $sql="UPDATE coleccion SET DescColeccion = '".$DescColecciones."' WHERE idColeccion=".$idColecciones;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>