<?php 

Class Proceso_InformeInstalacion{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function ListarInformeInstalacion(){
        $sql="SELECT * FROM informeInstalacion";
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

    function InsertarInformeInstalacion($mcpio,$responsables,$patrocinador,$fecha,$vereda,$centroEducativoRural,
    $NrofamiliasProgramadas,$NrofamiliasEntregadas,$instEducativas,$Educadores,$anteojos1_5,$anteojos2_5,$guias,$observaciones){
        $sql="INSERT INTO informeInstalacion (municipio,responsables,patrocinador,fecha,vereda,centroEducativoRural,
        NrofamiliasProgramadas,NrofamiliasEntregadas,instEducativas,Educadores,anteojos1_5,anteojos2_5,guias,observaciones)
         VALUES ('".$mcpio."','".$responsables."','".$patrocinador."','".$fecha."','".$vereda."','".$centroEducativoRural."',
         '".$NrofamiliasProgramadas."','".$NrofamiliasEntregadas."','".$instEducativas."','".$Educadores."','".$anteojos1_5."',
         '".$anteojos2_5."','".$guias."','"$observaciones."')";
         echo $sql;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarInformeInstalacion($vereda,$centroEducativoRural,$NrofamiliasProgramadas,$NrofamiliasEntregadas,
    $instEducativas,$Educadores,$anteojos1_5,$anteojos2_5,$guias,$observaciones){
        
        $sql="UPDATE informeInstalacion SET CodigoConceptoGasto='".$CodigoConceptoGasto."', DesConceptodeGasto='".$DesConceptodeGasto."',
        TarifaSN=".$TarifaSN.",TipodeGasto_idTipodeGasto=".$idTipodeGasto.",PlandeCuentas_idPlandeCuentas=".$idPlandeCuentas.",
        EstadoConceptoGasto=".$EstadoConceptoGasto." WHERE idConceptodeGasto=".$idConceptodeGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>