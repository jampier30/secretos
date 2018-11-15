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
	
							
		mysql_query("INSERT INTO regiones (codigo,nombre, estado) 
					VALUES ('$codigo','$nombre','$estado')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;
		$nombre=$this->nombre;		
		$estado=$this->estado;		
		
		mysql_query("UPDATE regiones SET
										codigo='$codigo',
										nombre='$nombre',
										estado='$estado'
									WHERE id='$id'");
	}
}
?>