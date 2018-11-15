<?php 

Class Proceso_Procesos{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidProcesos(){
        $lastid=0;
        $sql="SELECT MAX(idProceso) AS id FROM proceso";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertProcesos($desProcesos){
        $sql="INSERT INTO proceso (DescProceso) VALUES ('".$desProcesos."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaProcesos(){
        $sql="SELECT * FROM proceso";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarProcesos($desProcesos){
        $sql="SELECT * FROM proceso where DescProceso ='".$desProcesos."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarCodProcesos($idProceso){
        $sql="SELECT * FROM proceso where idProceso =".$idProceso;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function EditarProcesos($idProceso, $desProcesos){
        $sql="UPDATE proceso SET DescProceso = '".$desProcesos."'
         WHERE idProceso=".$idProceso;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>