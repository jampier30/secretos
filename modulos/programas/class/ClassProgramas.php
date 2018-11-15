<?php 

Class Proceso_Programa{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function getlastidProgramas(){
        $lastid=0;
        $sql="SELECT MAX(idPrograma) AS id FROM programa";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function InsertPrograma($descPrograma,$estado,$codigoPrograma){
        $sql="INSERT INTO programa (DescPrograma,EstadoPrograma,CodPrograma) VALUES ('".$descPrograma."','".$estado."','".$codigoPrograma."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaProgramas(){
        $sql="SELECT * FROM programa";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscardescPrograma($descPrograma){
        $sql="SELECT * FROM programa where DescPrograma='".$descPrograma."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarPrograma($idPrograma){
        $sql="SELECT * FROM programa where idPrograma=".$idPrograma;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;

    }

    function BuscarCodigoPrograma($CodigoPrograma){
        $sql="SELECT * FROM programa where CodPrograma='".$CodigoPrograma."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarPrograma($idprograma,$codigoprograma,$descPrograma,$estadoPrograma){
        $sql="UPDATE programa SET DescPrograma = '".$descPrograma."',
        EstadoPrograma = '".$estadoPrograma."', CodPrograma='".$codigoprograma."' WHERE idPrograma=".$idprograma;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

}


?>