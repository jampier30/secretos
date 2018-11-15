<?php 

Class Proceso_Departamento{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidDepartamento(){
        $lastid=0;
        $sql="SELECT MAX(idDepartamento) AS id FROM departamento";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertDepartamento($codDaneDpto, $nombDpto){
        $sql="INSERT INTO departamento (CodDaneDepartamento, NombreDepartamento	) VALUES ('".$codDaneDpto."','".$nombDpto."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaDepartamento(){
        $sql="SELECT * FROM departamento";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarDepartamento($nombDpto){
        $sql="SELECT * FROM departamento where NombreDepartamento ='".$nombDpto."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarCodDepartamento($codDaneDpto){
        $sql="SELECT * FROM departamento where CodDaneDepartamento =".$codDaneDpto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function BuscaridDepartamento($idDpto){
        $sql="SELECT * FROM departamento where idDepartamento ='".$idDpto."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarDepartamento($idDpto, $codDaneDpto, $nombDpto){
        $sql="UPDATE departamento SET idDepartamento = '".$idDpto."',
        CodDaneDepartamento = '".$codDaneDpto."', NombreDepartamento = '".$nombDpto."' WHERE idDepartamento=".$idDpto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>