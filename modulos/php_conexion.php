<?php
	
	$conexion = mysql_connect("127.0.0.1","root","Pilas2010");
	mysql_select_db("secretos",$conexion);
	date_default_timezone_set("America/Bogota");
    mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER_SET utf");
	$s='$';
?>