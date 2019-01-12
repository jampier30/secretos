<?php 

    Class Proceso_Alumnos{
    
        function __construct($InstanciaDB){
            $this->ConnxClass=$InstanciaDB;
         }
    
        function BuscarAlumnoAjax($search){
            $sql="SELECT * FROM alumno where NombreAlumno LIKE '%$search%'";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;
        }
        
        function ListarAlumnos(){
            $sql="SELECT alumno.*,
            institucion.NombreInstitucion
            FROM alumno
            INNER JOIN institucion ON institucion.idInstitucion=alumno.Institucion_idInstitucion";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;
        }

        function InsertAlumno($CodigoAlumno,$NombreAlumno,$EstadoAlumno,$EdadAlumno,$Institucion_idInstitucion){
            $sql="INSERT INTO alumno (CodigoAlumno,NombreAlumno,EstadoAlumno,EdadAlumno,Institucion_idInstitucion) 
            VALUES ('".$CodigoAlumno."','".$NombreAlumno."',".$EstadoAlumno.",'".$EdadAlumno."',".$Institucion_idInstitucion.")";
           $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;
        }

        function BuscarAlumnos($idAlumno){
            $sql="SELECT * FROM alumno where idAlumno ='".$idAlumno."'";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;

        }

        function BuscarAlumnosxCod($CodigoAlumno){
            $sql="SELECT * FROM alumno where CodigoAlumno ='".$CodigoAlumno."'";
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;

        }

        function EditarAlumno($idAlumno,$CodigoAlumno,$NombreAlumno,$EstadoAlumno,$EdadAlumno,$Institucion_idInstitucion){
            $sql="UPDATE alumno SET 
            CodigoAlumno='".$CodigoAlumno."',
            NombreAlumno='".$NombreAlumno."',
            EstadoAlumno=".$EstadoAlumno.",
            EdadAlumno='".$EdadAlumno."',
            Institucion_idInstitucion=".$Institucion_idInstitucion." 
            WHERE idAlumno=".$idAlumno;
            echo $sql;
            $this->resultado=$this->ConnxClass->link->query($sql) or trigger_error($this->con->error);
            return $this->resultado;	

        }
    
        
    }

?>