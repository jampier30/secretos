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

    function ListarDetallexidSolicitud($IdSolilcitudGasto,$EstadoDetalle){
        $sql="SELECT detallesolicitudgasto.*
        from detallesolicitudgasto where idConsecutivoSolicitudGasto=".$IdSolilcitudGasto." and EstadoRelacionDetalleSolicitud=".$EstadoDetalle;
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
        $sql="INSERT INTO detallesolicitudgasto (idConsecutivoSolicitudGasto, idConceptoGastoDetalleSolicitud, NumdiasTrayectoDetalleSolicitud,ValorUnitarioDetalleSolicitud,EstadoRelacionDetalleSolicitud)
        VALUES (".$idConsecutivoSolicitudGasto.",".$idConceptoGastoDetalleSolicitud.",".$NumdiasTrayectoDetalleSolicitud.",".$ValorUnitarioDetalleSolicitud.",0)";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function CambiarEstadoSG($IdSolicitudGasto,$nuevoEstadoSG){
        $sql="UPDATE solicitudgastos SET EstadoSolicitudGastos=".$nuevoEstadoSG." where idConsecutivoSolicitudGastos=".$IdSolicitudGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function RelacionSGSaldo(){
        $sql="SELECT solicitudgastos.*
        from solicitudgastos
        inner join relaciongastos on relaciongastos.idSolicitudGasto=solicitudgastos.idConsecutivoSolicitudGastos
        where (relaciongastos.TotalRelacionGastos >0) and (relaciongastos.TotalRelacionGastos < solicitudgastos.ValorTotalSolicitudGastos)";
         $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
         return $this->resultado;
    }

    function ObtenerCABdeIdSG($IdSG){
        $sql="SELECT solicitudgastos.*,
        municipio.NombreMunicipio,
        entidadvinculada.NombreEntidadVinculada,
        proyecto.DescProyecto,
        proceso.DescProceso,
        actividad.DescripcionActividad,
        legalizacionsolictudgasto.ValorLegalizacion
        FROM solicitudgastos
        INNER JOIN municipio on municipio.idMunicipio=solicitudgastos.idMunicipioSolicitudGastos
        INNER JOIN entidadvinculada on entidadvinculada.idEntidadVinculada=solicitudgastos.idEntidadVinculadaSolicitudGastos
        INNER JOIN proyecto on proyecto.idProyecto=solicitudgastos.idProyectoSolicitudGastos
        INNER JOIN proceso on proceso.idProceso=solicitudgastos.idProcesoSolicitudGastos
        INNER JOIN actividad on actividad.idActividad=solicitudgastos.idActividadSolicitudGastos
        INNER JOIN legalizacionsolictudgasto on legalizacionsolictudgasto.idSolicitudGasto=solicitudgastos.idConsecutivoSolicitudGastos
        WHERE solicitudgastos.idConsecutivoSolicitudGastos=".$IdSG;
         $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
         return $this->resultado;
    }

    function ObtenerCABdeIdSGLeg($IdSG){
        $sql="SELECT solicitudgastos.*,
        municipio.NombreMunicipio,
        entidadvinculada.NombreEntidadVinculada,
        proyecto.DescProyecto,
        proceso.DescProceso,
        actividad.DescripcionActividad
        FROM solicitudgastos
        INNER JOIN municipio on municipio.idMunicipio=solicitudgastos.idMunicipioSolicitudGastos
        INNER JOIN entidadvinculada on entidadvinculada.idEntidadVinculada=solicitudgastos.idEntidadVinculadaSolicitudGastos
        INNER JOIN proyecto on proyecto.idProyecto=solicitudgastos.idProyectoSolicitudGastos
        INNER JOIN proceso on proceso.idProceso=solicitudgastos.idProcesoSolicitudGastos
        INNER JOIN actividad on actividad.idActividad=solicitudgastos.idActividadSolicitudGastos
        WHERE solicitudgastos.idConsecutivoSolicitudGastos=".$IdSG;
         $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
         return $this->resultado;
    }
}
?>