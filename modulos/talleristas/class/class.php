<?php
class Proceso_Paciente{
	var $id;	
	var $codigo;
	var $nombre;
    var $salario;		
	var $responsabilidad;	
	var $ttallerista;		
	var $estado;

	function __construct($id,$codigo,$nombre,$salario,$responsabilidad,$ttallerista,$estado){
		$this->id=$id;		
		$this->codigo=$codigo;
		$this->nombre=$nombre;		
		$this->salario=$salario;	
		$this->responsabilidad=$responsabilidad;
		$this->ttallerista=$ttallerista;	
		$this->estado=$estado;	
;	
	}
	
	function crear(){
		$id=$this->id;		
		$codigo=$this->codigo;
		$nombre=$this->nombre;		
		$salario=$this->salario;	
		$responsabilidad=$this->responsabilidad;	
		$ttallerista=$this->ttallerista;	
		$estado=$this->estado;	
	
							
		mysql_query("INSERT INTO talleristas (codigo,nombre, salario, responsabilidad, ttallerista, estado) 
					VALUES ('$codigo','$nombre','$salario','$responsabilidad','$ttallerista','$estado')");
	}
	
	function actualizar(){
		$id=$this->id;		
		$codigo=$this->codigo;
		$nombre=$this->nombre;		
		$salario=$this->salario;	
		$responsabilidad=$this->responsabilidad;	
		$ttallerista=$this->ttallerista;	
		$estado=$this->estado;		
		
		mysql_query("UPDATE talleristas SET
										codigo='$codigo',
										nombre='$nombre',
										salario='$salario',
										responsabilidad='$responsabilidad',
										ttallerista='$ttallerista',
										estado='$estado'
									WHERE id='$id'");
	}
}
?>