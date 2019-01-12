<?php
function consultar($campo,$tabla,$where){
		$sql=mysql_query("SELECT * FROM $tabla WHERE $where");
		if($row=mysql_fetch_array($sql)){
			return $row[$campo];
		}else{
			return '';	
		}
	}
	
	function abonos_saldo($cuenta){
		$sql=mysql_query("SELECT SUM(valor) as valores FROM abono WHERE cuenta='$cuenta'");
		if($row=mysql_fetch_array($sql)){
			return $row['valores'];
		}else{
			return 0;	
		}
	}

	function encrypt($string, $key) {
		$result = ''; $key=$key.'2013';
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)+ord($keychar));
			  $result.=$char;
	   	}
	   	return base64_encode($result);
	}
	#####CONTRASEÑA DE-ENCRIPTAR
	function decrypt($string, $key) {
	   	$result = ''; $key=$key.'2013';
	   	$string = base64_decode($string);
	   	for($i=0; $i<strlen($string); $i++) {
			  $char = substr($string, $i, 1);
			  $keychar = substr($key, ($i % strlen($key))-1, 1);
			  $char = chr(ord($char)-ord($keychar));
			  $result.=$char;
	   	}
	   	return $result;
	}
	
	function cadenas(){
		return 'YABCDFGJAH';	
	}
	
	function diaSemana($ano,$mes,$dia){
		$dias = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SABADO");
		$dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
		return $dias[$dia];
	}
	
	function fecha($fecha){
		$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
		$a=substr($fecha, 0, 4); 	
		$m=substr($fecha, 5, 2); 
		$d=substr($fecha, 8);
		return $d." / ".$meses[$m-1]." / ".$a;
	}
	function sexo($estado){
		if($estado=='m'){
			return 'Masculino';
		}else{
			return 'Femenino';
		}
	}
	
	function estado($estado){
		if($estado=='s'){
			return '<span class="label label-success">Activo</span>';
		}else{
			return '<span class="label label-danger">No Activo</span>';
		}
	}

	function config($config){
		if($config=='df'){
			return '<span class="label label-danger">Tarifa por Defaul</span>';
		}else{
			return '<span class="label label-success">General</span>';
		}
	}
	function status($status){
		if($status=='CANCELADO'){
			return '<span class="label label-success">CANCELADO</span>';
		}else{
			return '<span class="label label-danger">PENDIENTE</span>';
		}
	}
		
	function usuario($tipo){
		if($tipo=='a'){
			return 'ADMINISTRADOR';
		}elseif($tipo=='c'){
			return 'CAJERO';
		}
	}
	
	function mensajes($mensaje,$tipo){
		if($tipo=='verde'){
			$tipo='alert alert-success';
		}elseif($tipo=='rojo'){
			$tipo='alert alert-danger';
		}elseif($tipo=='azul'){
			$tipo='alert alert-info';
		}
		return '<div class="'.$tipo.'" align="center">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>'.$mensaje.'</strong>
            </div>';
	}
	
	function formato($valor){
		return number_format($valor,2,".",",");
	}

	function limpiar($tags){
		$tags= ltrim(rtrim(strip_tags($tags)));
		return $tags;
	}
	
	
	function tiempo($codigo){
		if($codigo=='S1'){
			return 'Primer Semestre del Año';
		}elseif($codigo=='S2'){
			return 'Segundo Semestre del Año';
		}elseif($codigo=='I1'){
			return 'Primer Intersemestral';
		}elseif($codigo=='I2'){
			return 'Segundo Intersemestral';
		}elseif($codigo=='AE'){
			return 'Año Escolar';
		}
	}
	
	function permiso($usu,$id){
		$consulta=mysql_query("SELECT * FROM permisos WHERE usu='$usu' and permiso='$id' and estado='s'");
		if($v=mysql_fetch_array($consulta)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function colocar_permiso($usu,$tipo){
		if($tipo=='admin'){
			$sql=mysql_query("SELECT * FROM tipo_permisos WHERE tipo='$tipo'");
			while($row=mysql_fetch_array($sql)){
				$permiso=$row['permiso'];
				mysql_query("INSERT INTO permisos (permiso,usu,estado) VALUES ('$permiso','$usu','s')");
			}
		}else{
			$sql=mysql_query("SELECT * FROM tipo_permisos WHERE tipo='$tipo'");
			while($row=mysql_fetch_array($sql)){
				$permiso=$row['permiso'];
				$estado=$row['estado'];
				mysql_query("INSERT INTO permisos (permiso,usu,estado) VALUES ('$permiso','$usu','$estado')");
			}
		}
	}



	function SubirImagenDetalleRelacionSG($IdRSG,$IdDetalleSG){

		
			$target_dir = "/imgrelaciongastos/RSG".$IdRSG."DSG".$IdDetalleSG;
			$carpeta=$target_dir;
			if (!file_exists($carpeta)) {
				mkdir($carpeta, 0777, true);
			}
			
			$target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$errors[]= "El archivo no es una imagen.";
					$uploadOk = 0;
				}
			}
			if (file_exists($target_file)) {
				$errors[]="Lo sentimos, archivo ya existe.";
				$uploadOk = 0;
			}
			
			if ($_FILES["fileToUpload"]["size"] > 5242880) {
				$errors[]= "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 5 MB";
				$uploadOk = 0;
			}
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf") {
				$errors[]= "Lo sentimos, sólo archivos JPG, JPEG, PNG, GIF y PDF  son permitidos.";
				$uploadOk = 0;
			}
			
			if ($uploadOk == 0) {
				$errors[]= "Lo sentimos, tu archivo no fue subido.";
			
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$messages[]= "El Archivo ha sido subido correctamente.";

				} else {
					$errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
				}
			}
			
			if (isset($errors)){
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Error!</strong> 
					<?php
					foreach ($errors as $error){
						echo"<p>$error</p>";
					}
					?>
				</div>
				<?php
			}
			
			if (isset($messages)){
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Aviso!</strong> 
					<?php
					foreach ($messages as $message){
						echo"<p>$message</p>";
					}
					?>
				</div>
				<?php
			}
		
	}
	
	/*function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
	}*/

	function CalculaEdad($fecha)
	{
	list($Y,$m,$d) = explode("-",$fecha);
	return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	function primera_mayuscula($cadena){
		$cadena=mb_convert_case($cadena, MB_CASE_TITLE, "utf8");
		return($cadena);
	}

	function texto_mayusculas($cadena){
		$cadena=strtoupper($cadena);
		return($cadena);
	}
?>