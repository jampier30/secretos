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

        function BuscarEmpleado(){


        }

        function EditarEmpleado(){


        }
    
        
    }

?>