<?php 

    Class Proceso_Empleados{
    
        function __construct($InstanciaDB){
            $this->ConnxClass=$InstanciaDB;
         }
    
        function BuscarEmpleadoAjax($search){
            $sql="SELECT * FROM empleado where NombreEmpleado LIKE '%$search%'";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;
        }
        
        function listarArea(){
             $sql="SELECT * FROM area";
             $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
             return $this->resultado;
        }

        function ListarEmpleados(){
            $sql="SELECT
            empleado.idEmpleado,
            empleado.DocumentoEmpleado,
            empleado.NombreEmpleado,
            empleado.TelefonoEmpleado,
            empleado.CargoEmpleado,
            empleado.idAreaEmpleado,
            empleado.EstadoEmpleado,
            empleado.idusuarioEmpleado,
            area.idArea,
            area.DescArea,
            usuario.idUsuario,
            usuario.NombreUsuario
            FROM empleado
            INNER JOIN area
            ON area.idArea=empleado.idAreaEmpleado
            INNER JOIN usuario
            ON usuario.idUsuario=empleado.idusuarioEmpleado";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;
        }

        function InsertEmpleado($DocumentoEmpleado,$NombreEmpleado,$TelefonoEmpleado,$CargoEmpleado,$idAreaEmpleado,
        $EstadoEmpleado,$idusuarioEmpleado){
            $sql="INSERT INTO empleado (DocumentoEmpleado,NombreEmpleado,TelefonoEmpleado,CargoEmpleado,
            idAreaEmpleado,EstadoEmpleado,idusuarioEmpleado) 
            VALUES (".$DocumentoEmpleado.",'".$NombreEmpleado."','".$TelefonoEmpleado."','".$CargoEmpleado."',".$idAreaEmpleado.",
            ".$EstadoEmpleado.",".$idusuarioEmpleado.")"; 
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;
        }


        function BuscarEmpleado($DocumentoEmpleado){
            $sql="SELECT * FROM empleado where DocumentoEmpleado ='".$DocumentoEmpleado."'";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;

        }

        function EditarEmpleado($idEmpleado,$DocumentoEmpleado,$NombreEmpleado,$TelefonoEmpleado,$CargoEmpleado,$idAreaEmpleado,
        $EstadoEmpleado,$idusuarioEmpleado){
            $sql="UPDATE alumno SET 
            DocumentoEmpleado=".$DocumentoEmpleado.",
            NombreEmpleado='".$NombreEmpleado."',
            TelefonoEmpleado='".$TelefonoEmpleado."',
            CargoEmpleado=".$CargoEmpleado.",
            idAreaEmpleado=".$idAreaEmpleado.",
            EstadoEmpleado=".$EstadoEmpleado.",
            idusuarioEmpleado=".$idusuarioEmpleado." 
            WHERE idEmpleado=".$idEmpleado;
            echo $sql;
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;

        }
    
        
    }

?>