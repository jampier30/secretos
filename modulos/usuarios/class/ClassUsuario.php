<?php

Class Proceso_Usuario{
    
    public $ConnxClass;
    public $EmailLogin;
    public $ClaveLogin;

    function __construct($InstanciaDB){
       $this->ConnxClass=$InstanciaDB;
    }

    function BuscarLogin($EmailLogin){
        $sql="SELECT * FROM usuario where EmailUsuario='".$EmailLogin."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }
    
    function InsertarUsuario($EmailUsuario,$ClaveUsuario,$EstadoUsuario,$NombreUsuario){
        $sql="INSERT INTO usuario (EmailUsuario,ClaveUsuario,EstadoUsuario,NombreUsuario) VALUES ('".$EmailUsuario."', '".$ClaveUsuario."', ".$EstadoUsuario.", '".$NombreUsuario."')";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarEmailUsuario($EmailUsuario){
        $sql="SELECT * FROM usuario where EmailUsuario='".$EmailUsuario."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function BuscarUsuario($IdUsuario){
        $sql="SELECT * FROM usuario where IdUsuario='".$IdUsuario."'";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarEstadoUsuario($idUsuario,$EstadoUsuario){
        $sql="UPDATE usuario SET EstadoUsuario = '".$EstadoUsuario."' WHERE idUsuario=".$idUsuario;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function EditarUsuario($idUsuario,$NombreUsuario,$EstadoUsuario){
        $sql="UPDATE usuario SET EstadoUsuario = '".$EstadoUsuario."', NombreUsuario='".$NombreUsuario."' WHERE idUsuario=".$idUsuario;
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function ListaUsuario(){
        $sql="SELECT * FROM usuario";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        return $this->resultado;
    }

    function getlastidUsuario(){
        $sql="SELECT MAX(idUsuario) AS idUsuario FROM Usuario";
        $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
        if ($this->resultado->num_rows > 0) {
            $this->lastidusuario=$this->resultado->fetch_array(MYSQLI_BOTH);
        }
        return $this->lastidusuario[0];
    }
}
?>