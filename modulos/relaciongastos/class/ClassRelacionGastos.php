<?php 

Class Proceso_RelacionGastos{ 

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function ListarRelacionGasto(){
        
        $sql="SELECT * FROM relaciongastos  ORDER BY idRelacionGastos";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarDetalleRelacionGasto($idRelacionGastos, $idDetalleSolicitudGastos, $ObservacionDetalleRelacion, $BeneficiarioDetalleRelacion, $NumFacturaDetalleRelacion, $ValorFacturaDetalleRelacion, $PagoTCEDetalleRelacion, $ImagenDetalleRelacion){
        // $sql="";
        // $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        // return $this->resultado;
    }
    
    function InsertarCabRelacionGasto($idSolicitudGasto,$FechaRelacionGastos,$ObservacionesRelacionGasto,$UsuarioRelacionGastos){
        $sql="INSERT INTO relaciongastos
        (idSolicitudGasto,FechaRelacionGastos,ObservacionesRelacionGastos,UsuarioRelacionGastos)
        VALUES (".$idSolicitudGasto.",'".$FechaRelacionGastos."','".$ObservacionesRelacionGasto."',".$UsuarioRelacionGastos.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->ConnxClass->link->insert_id;
    }
    
    function BuscarRelacionGastoxId($IdRelacionGasto){
        // $sql="";
        // $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        // return $this->resultado; 
    }

    function BuscarRelacionGastoxIdSolicitud($IdSolicitudGasto){
        // $sql="";
        // $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        // return $this->resultado;
    }
    
    function InsLineaDetalleReacionSG($idRelacionGastos,$idDetalleSolicitudGastos,$NitBeneficiarioDetalleRelacion,$NombreBeneficiarioDetalleRelacion,$NumFacturaDetalleRelacion,$ValorFacturaDetalleRelacion,$PagoTCEDetalleRelacion,$ObservacionDetalleRelacion,$ImagenDetalleRelacion){
        $sql="INSERT INTO detallerelaciongasto
        (idRelacionGastos,idDetalleSolicitudGastos,NitBeneficiarioDetalleRelacion,NombreBeneficiarioDetalleRelacion,NumFacturaDetalleRelacion,ValorFacturaDetalleRelacion,PagoTCEDetalleRelacion,ObservacionDetalleRelacion,ImagenDetalleRelacion)
        VALUES (".$idRelacionGastos.",".$idDetalleSolicitudGastos.", '".$NitBeneficiarioDetalleRelacion."', '".$NombreBeneficiarioDetalleRelacion."','".$NumFacturaDetalleRelacion."',".$ValorFacturaDetalleRelacion.", ".$PagoTCEDetalleRelacion.",'".$ObservacionDetalleRelacion."', '".$ImagenDetalleRelacion."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}

?>