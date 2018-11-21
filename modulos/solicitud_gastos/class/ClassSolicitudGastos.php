<?php 

Class Proceso_SolicitudGastos{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function ListarSolicitudGastos(){
        $sql="SELECT 
        solicitudgastos.*,
        municipio.NombreMunicipio
        FROM solicitudgastos 
        INNER JOIN municipio ON municipio.idMunicipio=solicitudgastos.idMunicipioSolicitudGastos";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListarSolicitudGastosxEstado($EstadoSG){
        $sql="SELECT 
        solicitudgastos.*,
        municipio.NombreMunicipio
        FROM solicitudgastos 
        INNER JOIN municipio ON municipio.idMunicipio=solicitudgastos.idMunicipioSolicitudGastos
        where EstadoSolicitudGastos=".$EstadoSG;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarSolicitudGastosxid($idSolicitudGastos){
        $sql="SELECT 
        solicitudgastos.*,
        municipio.NombreMunicipio
        FROM solicitudgastos 
        INNER JOIN municipio ON municipio.idMunicipio=solicitudgastos.idMunicipioSolicitudGastos
        where solicitudgastos.idConsecutivoSolicitudGastos=".$idSolicitudGastos;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarSolicitudGastos($FechaSolicitud,$CodProyectoSG,$CodProcesoSG,$CodActividadSG,$CodMunicipioSG,$CodEntidadSG,$FechaHoraSalidaSG,$FechaHoraRegresoSG,$CantColeccionSG,$TipoColeccionSG,$TotalSolicitudGastoSG){
        $sql="INSERT INTO solicitudgastos (FechaSolicitud,idProyectoSolicitudGastos,idProcesoSolicitudGastos,idActividadSolicitudGastos,idMunicipioSolicitudGastos,idEntidadVinculadaSolicitudGastos,FechaSalidaSolicitudGastos,FechaRegresoSolicitudGastos,CantColeccionSolicitudGastos,TipoColeccionSolicitudGastos,EstadoSolicitudGastos,ValorTotalSolicitudGastos) VALUES ('".$FechaSolicitud."',".$CodProyectoSG.",".$CodProcesoSG.",".$CodActividadSG.",".$CodMunicipioSG.",".$CodEntidadSG.",'".$FechaHoraSalidaSG."','".$FechaHoraRegresoSG."',".$CantColeccionSG.",'".$TipoColeccionSG."',0,".$TotalSolicitudGastoSG.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->ConnxClass->link->insert_id;
    }

    function EditarSolicitudGastos($idConceptodeGasto,$CodigoConceptoGasto,$DesConceptodeGasto,$TarifaSN,$idTipodeGasto,$idPlandeCuentas,$EstadoConceptoGasto){
        $sql="UPDATE solicitudgastos SET CodigoConceptoGasto='".$CodigoConceptoGasto."', DesConceptodeGasto='".$DesConceptodeGasto."',TarifaSN=".$TarifaSN.",TipodeGasto_idTipodeGasto=".$idTipodeGasto.",PlandeCuentas_idPlandeCuentas=".$idPlandeCuentas.",EstadoConceptoGasto=".$EstadoConceptoGasto." WHERE idConceptodeGasto=".$idConceptodeGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ObtenerultimaSolicitudGasto(){
        $lastid=0;
        $sql="SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'secretospc' AND   TABLE_NAME   = 'solicitudgastos'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastid=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastid[0];
    }

    function listardetalleTMP(){
        $sql="SELECT * FROM tmp_detallesolicitudgastos";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListarDetallexidSolicitud($IdSolilcitudGasto){
        $sql="SELECT detallesolicitudgasto.*
        from detallesolicitudgasto where idConsecutivoSolicitudGasto=".$IdSolilcitudGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function borrarlineadetalleTMP($idTMP_DetalleSolicitudGastos){ 
        $sql="DELETE FROM tmp_detallesolicitudgastos WHERE idTMP_DetalleSolicitudGastos=".$idTMP_DetalleSolicitudGastos;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarDetalleTMP($ConceptoSolicitud,$Numerodias,$ValorSolicitud){
        $sql="INSERT INTO tmp_detallesolicitudgastos (TMP_IdConceptoSolicitudGastos,TMP_NumDisSolicitudGastos,TMP_ValorundSolicitudGastos) VALUES (".$ConceptoSolicitud.",".$Numerodias.",".$ValorSolicitud.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function getnombreconceptoGasto($IdConceptoGasto){
        $sql="SELECT * FROM conceptodegasto where idConceptodeGasto=".$IdConceptoGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->rowCG=$this->resultado->fetch_array(MYSQLI_BOTH);
            $this->nombreCG=$this->rowCG[2];
        }
        return $this->nombreCG;
    }

    function vaciarTMPDetalle(){
        $sql="TRUNCATE TABLE tmp_detallesolicitudgastos";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarResponsablesSG($ConsecutivoSolicitud,$idResponsableSG){
        $sql="INSERT INTO solicitudgastos_has_empleado (solicitudgastos_idConsecutivoSolicitudGastos,Empleado_DocumentoEmpleado) VALUES (".$ConsecutivoSolicitud.",".$idResponsableSG.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaResponsablesxIDsolicitud($idSolcitudGastos){
        $sql="SELECT
            solicitudgastos_has_empleado.*
            from solicitudgastos_has_empleado
            where solicitudgastos_idConsecutivoSolicitudGastos=".$idSolcitudGastos;
            
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarTPMaDetalle($idConsecutivoSolicitudGasto, $idConceptoGastoDetalleSolicitud, $NumdiasTrayectoDetalleSolicitud,$ValorUnitarioDetalleSolicitud){
        $sql="INSERT INTO detallesolicitudgasto (idConsecutivoSolicitudGasto, idConceptoGastoDetalleSolicitud, NumdiasTrayectoDetalleSolicitud,ValorUnitarioDetalleSolicitud)
        VALUES (".$idConsecutivoSolicitudGasto.",".$idConceptoGastoDetalleSolicitud.",".$NumdiasTrayectoDetalleSolicitud.",".$ValorUnitarioDetalleSolicitud.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function CambiarEstadoSG($IdSolicitudGasto){
        $sql="UPDATE solicitudgastos SET EstadoSolicitudGastos=1 where idConsecutivoSolicitudGastos=".$IdSolicitudGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>