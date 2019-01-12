<?php 

Class Proceso_EntregaAnteojos{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function ListarEntregaAnteojos(){
        $sql="SELECT entrega_anteojos.*,
        empleado.NombreEmpleado,
        municipio.NombreMunicipio,
        alumno.NombreAlumno
         FROM entrega_anteojos
         INNER JOIN empleado ON entrega_anteojos.IdresponsableEntrega=empleado.idEmpleado
         INNER JOIN municipio ON entrega_anteojos.municipioEntrega=municipio.idMunicipio
         INNER JOIN alumno ON entrega_anteojos.beneficiario=alumno.idAlumno";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarConceptoGastoxid($idConceptodeGasto){
        $sql="SELECT entregaanteojos.idConceptodeGasto, conceptodegasto.CodigoConceptoGasto, conceptodegasto.DesConceptodeGasto, conceptodegasto.TarifaSN, tipodegasto.DescTipodeGasto, plandecuentas.DescPlandeCuentas, conceptodegasto.EstadoConceptoGasto,tipodegasto.idTipodeGasto,plandecuentas.idPlandeCuentas FROM conceptodegasto INNER JOIN tipodegasto ON conceptodegasto.TipodeGasto_idTipodeGasto=tipodegasto.idTipodeGasto INNER JOIN plandecuentas ON plandecuentas.idPlandeCuentas=conceptodegasto.PlandeCuentas_idPlandeCuentas where idConceptodeGasto=".$idConceptodeGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarConceptoGastoxcod($CodigoConceptoGasto){
        $sql="SELECT entregaanteojos.idConceptodeGasto, conceptodegasto.CodigoConceptoGasto, conceptodegasto.DesConceptodeGasto, conceptodegasto.TarifaSN, tipodegasto.DescTipodeGasto, plandecuentas.DescPlandeCuentas, conceptodegasto.EstadoConceptoGasto,tipodegasto.idTipodeGasto,plandecuentas.idPlandeCuentas FROM conceptodegasto INNER JOIN tipodegasto ON conceptodegasto.TipodeGasto_idTipodeGasto=tipodegasto.idTipodeGasto INNER JOIN plandecuentas ON plandecuentas.idPlandeCuentas=conceptodegasto.PlandeCuentas_idPlandeCuentas where CodigoConceptoGasto='".$CodigoConceptoGasto."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarEntregaAnteojos($IdResponsableEntr,$idVdaBenef,$mcpioEntrega,$fechaEntrega,$Beneficiario,$telBeneficiario,
    $correoBeneficiario,$personaRecibe,$tipoAnteojos){
        $sql="INSERT INTO entrega_anteojos (IdresponsableEntrega,IdVeredaBeneficiario,municipioEntrega,
        fechaEntrega,beneficiario,telefonoBeneficiario,correoBeneficiario,personaRecibe,tipoAnteojos)
         VALUES ('".$IdResponsableEntr."','".$idVdaBenef."','".$mcpioEntrega."','".$fechaEntrega."','".$Beneficiario."',
         '".$telBeneficiario."','".$correoBeneficiario."','".$personaRecibe."','".$tipoAnteojos."')";
         echo $sql;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarConceptoGasto($idConceptodeGasto,$CodigoConceptoGasto,$DesConceptodeGasto,$TarifaSN,$idTipodeGasto,$idPlandeCuentas,$EstadoConceptoGasto){
        $sql="UPDATE entregaanteojos SET CodigoConceptoGasto='".$CodigoConceptoGasto."', DesConceptodeGasto='".$DesConceptodeGasto."',TarifaSN=".$TarifaSN.",TipodeGasto_idTipodeGasto=".$idTipodeGasto.",PlandeCuentas_idPlandeCuentas=".$idPlandeCuentas.",EstadoConceptoGasto=".$EstadoConceptoGasto." WHERE idConceptodeGasto=".$idConceptodeGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>