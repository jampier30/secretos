<?php
class Proceso_Paciente{
	var $id;	
	var $codigo;
	var $nombre;
	var $estado;


	function __construct($id,$codigo,$nombre,$estado){
		$this->id=$id;		
		$this->codigo=$codigo;
		$this->nombre=$nombre;		
		$this->estado=$estado;	
;	
	}
	
	function crear(){
		$id=$this->id;		
		$codigo=$this->codigo;
		$nombre=$this->nombre;		
		$estado=$this->estado;	
		$usu =$_SESSION['cod_user'];
		$fcrea =date("Y-m-d");
							
		mysql_query("INSERT INTO tipo_novedades (codigo,nombre, estado,usuario,fcreacion) 
					VALUES ('$codigo','$nombre','$estado', '$usu','$fcrea')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;
		$nombre=$this->nombre;		
		$estado=$this->estado;		
		$fmod =date("Y-m-d");	
		mysql_query("UPDATE tipo_novedades SET
										codigo='$codigo',
										nombre='$nombre',
										fmodifica='$fmod',
										estado='$estado'
									WHERE id='$id'");
	}
}
?>