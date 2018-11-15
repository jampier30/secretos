<?php 

Class Proceso_ConceptoGastos{

    function __construct($InstanciaDB){
        $this->ConnxClass=$InstanciaDB;
     }

    function ListarConceptoGastos(){
        $sql="SELECT conceptodegasto.idConceptodeGasto, conceptodegasto.CodigoConceptoGasto, conceptodegasto.DesConceptodeGasto, conceptodegasto.TarifaSN, tipodegasto.DescTipodeGasto, plandecuentas.DescPlandeCuentas, conceptodegasto.EstadoConceptoGasto,tipodegasto.idTipodeGasto,plandecuentas.idPlandeCuentas FROM conceptodegasto INNER JOIN tipodegasto ON conceptodegasto.TipodeGasto_idTipodeGasto=tipodegasto.idTipodeGasto INNER JOIN plandecuentas ON plandecuentas.idPlandeCuentas=conceptodegasto.PlandeCuentas_idPlandeCuentas";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarConceptoGastoxid($idConceptodeGasto){
        $sql="SELECT conceptodegasto.idConceptodeGasto, conceptodegasto.CodigoConceptoGasto, conceptodegasto.DesConceptodeGasto, conceptodegasto.TarifaSN, tipodegasto.DescTipodeGasto, plandecuentas.DescPlandeCuentas, conceptodegasto.EstadoConceptoGasto,tipodegasto.idTipodeGasto,plandecuentas.idPlandeCuentas FROM conceptodegasto INNER JOIN tipodegasto ON conceptodegasto.TipodeGasto_idTipodeGasto=tipodegasto.idTipodeGasto INNER JOIN plandecuentas ON plandecuentas.idPlandeCuentas=conceptodegasto.PlandeCuentas_idPlandeCuentas where idConceptodeGasto=".$idConceptodeGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarConceptoGastoxcod($CodigoConceptoGasto){
        $sql="SELECT conceptodegasto.idConceptodeGasto, conceptodegasto.CodigoConceptoGasto, conceptodegasto.DesConceptodeGasto, conceptodegasto.TarifaSN, tipodegasto.DescTipodeGasto, plandecuentas.DescPlandeCuentas, conceptodegasto.EstadoConceptoGasto,tipodegasto.idTipodeGasto,plandecuentas.idPlandeCuentas FROM conceptodegasto INNER JOIN tipodegasto ON conceptodegasto.TipodeGasto_idTipodeGasto=tipodegasto.idTipodeGasto INNER JOIN plandecuentas ON plandecuentas.idPlandeCuentas=conceptodegasto.PlandeCuentas_idPlandeCuentas where CodigoConceptoGasto='".$CodigoConceptoGasto."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function InsertarConceptoGasto($CodigoConceptoGasto,$DesConceptodeGasto,$TarifaSN,$idTipodeGasto,$idPlandeCuentas,$EstadoConceptoGasto){
        $sql="INSERT INTO conceptodegasto (CodigoConceptoGasto,DesConceptodeGasto,TarifaSN,TipodeGasto_idTipodeGasto,PlandeCuentas_idPlandeCuentas,EstadoConceptoGasto) VALUES ('".$CodigoConceptoGasto."','".$DesConceptodeGasto."',".$TarifaSN.",".$idTipodeGasto.",".$idPlandeCuentas.",".$EstadoConceptoGasto.")";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarConceptoGasto($idConceptodeGasto,$CodigoConceptoGasto,$DesConceptodeGasto,$TarifaSN,$idTipodeGasto,$idPlandeCuentas,$EstadoConceptoGasto){
        $sql="UPDATE conceptodegasto SET CodigoConceptoGasto='".$CodigoConceptoGasto."', DesConceptodeGasto='".$DesConceptodeGasto."',TarifaSN=".$TarifaSN.",TipodeGasto_idTipodeGasto=".$idTipodeGasto.",PlandeCuentas_idPlandeCuentas=".$idPlandeCuentas.",EstadoConceptoGasto=".$EstadoConceptoGasto." WHERE idConceptodeGasto=".$idConceptodeGasto;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
}
?>