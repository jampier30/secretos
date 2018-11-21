<?php 

Class Proceso_LegalizacionSolicitudGastos{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function ListarLegalizSolicitudGastos(){
        $sql="SELECT * FROM legalizacionsolictudgasto";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarLegalizSolicitudGastosxid($idLegalizacionSolictudGasto){
        $sql="SELECT * FROM legalizacionsolictudgasto where idLegalizacionSolictudGasto ='".$idLegalizacionSolictudGasto."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarLegalizSolicitudGastos($idSolicitudGasto, $FechaLegalizacion,$UsuarioLegalizacion,$ValorLegalizacion){
        $sql="INSERT INTO legalizacionsolictudgasto (idSolicitudGasto,FechaLegalizacion,UsuarioLegalizacion,ValorLegalizacion)
         VALUES(".$idSolicitudGasto.",'".$FechaLegalizacion."',".$UsuarioLegalizacion.",".$ValorLegalizacion.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarLegalizacSolicitudGastos($idLegalizacionSolictudGasto,$idSolicitudGasto,
    $FechaLegalizacion,$UsuarioLegalizacion,$ValorLegalizacion){
        $sql="UPDATE solicitudgastos SET idSolicitudGasto='".$idSolicitudGasto."', FechaLegalizacion='".$FechaLegalizacion."',
        UsuarioLegalizacion=".$UsuarioLegalizacion.", ValorLegalizacion='".$ValorLegalizacion."'
       WHERE idLegalizacionSolictudGasto=".$idLegalizacionSolictudGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ObtenerultimaSolicitudGasto(){
        $lastid=0;
        $sql="SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'secretospc' AND
           TABLE_NAME   = 'solicitudgastos'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

}
?>