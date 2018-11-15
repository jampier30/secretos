<?php 
	session_start();
	include_once "../php_conexion.php";
	include_once "class/class.php";
	include_once "../funciones.php";
	include_once "../class_buscar.php";
	if($_SESSION['cod_user']){
	}else{
		header('Location: ../../php_cerrar.php');
	}
	
	$usu=$_SESSION['cod_user'];
	 $pa=mysql_query("SELECT * FROM cajero WHERE usu='$usu'");				
	while($row=mysql_fetch_array($pa)){
		$id_consultorio=$row['consultorio'];
		$oConsultorio=new Consultar_Deposito($id_consultorio);
		$nombre_Consultorio=$oConsultorio->consultar('nombre');
	} 
	
	$oPersona=new Consultar_Cajero($usu);
	$cajero_nombre=$oPersona->consultar('nom');
	$fecha=date('Y-m-d');
	$hora=date('H:i:s');
	
	######### TRAEMOS LOS DATOS DE LA EMPRESA #############
		$pa=mysql_query("SELECT * FROM empresa WHERE id=1");				
        if($row=mysql_fetch_array($pa)){
			$nombre_empresa=$row['empresa'];
		}
	
	if(!empty($_GET['del'])){
		$id=$_GET['del'];
		mysql_query("DELETE FROM tipo_novedades WHERE id='$id'");
		header('index.php');
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $nombre_empresa; ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="../../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- CALENDARIO STYLES-->
	<link href="../../assets/todo/bootstrap-datetimepicker.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="../../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../usuarios/perfil.php"><?php echo $_SESSION['user_name']; ?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Oficina: <?php echo $nombre_Consultorio; ?> :: Fecha de Acceso : <?php echo fecha(date('Y-m-d')); ?> &nbsp; <a href="../../php_cerrar.php" class="btn btn-danger square-btn-adjust">Salir</a> </div>
        </nav>   
           <?php include_once "../../menu/m_talleristas.php"; ?>
        <div id="page-wrapper" >
            <div id="page-inner">
				<div class="panel-body">                                              
<?php if(permiso($_SESSION['cod_user'],'1')==TRUE){ ?>	                               
				  <!--  Modals-->
								 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<form name="form1" method="post" action="">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													
														<h3 align="center" class="modal-title" id="myModalLabel">Nuevo </h3>
													</div>
										<div class="panel-body">
										<div class="row">
										 <ul class="nav nav-tabs nav-justified">
                                            <li class="active"><a href="#personal" data-toggle="tab"><i class="glyphicon glyphicon-user" ></i> DATOS </a></li>
                                                                                                                                                                                                                           
                                         </ul>
                                         	<div class="tab-content">
                                         	<div class="tab-pane fade active in" id="personal">									
											<div class="col-md-12">
											<br>			
											<input class="form-control" name="codigo" placeholder="Codigo"  autocomplete="off" required><br>											
											<input class="form-control" title="Se necesita un nombre"  name="nombre" placeholder="Nombre Completo" autocomplete="off" required autofocus><br>
											</div>
											<div class="col-md-6">
												<!--<input class="form-control" name="edad" title="Se necesita una Edad" pattern="^[0-9.!#$%&'*+/=?^_`{|}~-]*$" placeholder="Edad" autocomplete="off" required><br>
												<input placeholder="Fecha de Nacimiento" type="text" onfocus="(this.type='date')"  class="form-control" name="edad" min="1"  autocomplete="off" required><br>-->																			 
												<select class="form-control" name="estado" placeholder="Estado" autocomplete="off" required>						
													<option value="s">Activo</option>
													<option value="n">No Activo</option>													
												</select>
											</div>
											</div>
																																												                                                            
											</div> 																																												                                                            
										</div> 
										</div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>										 
                                    </div>
                                </div>
								</form>
                            </div>
                     <!-- End Modals-->
					  
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							TIPO NOVEDADES
							<ul class="nav pull-right">
								<a href="" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" title="Agregar Paciente" title="Agregar"><i class="fa fa-plus"> </i> <strong>Nuevo</strong></a>								                            																										                            
							</ul>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
								<?php 
									if(!empty($_POST['nombre'])){ 
										$codigo=limpiar($_POST['codigo']);
										$nombre=limpiar($_POST['nombre']);		
										$estado=limpiar($_POST['estado']);
			
										
										if(empty($_POST['id'])){
											$oPaciente=new Proceso_Paciente('',$codigo,$nombre,$estado);
											$oPaciente->crear();
											echo mensajes('Registro "'.$nombre.'" Creado con Exito','verde');
										}else{
											$id=limpiar($_POST['id']);
											$oPaciente=new Proceso_Paciente($id,$codigo,$nombre,$estado);
											$oPaciente->actualizar();
											echo mensajes('Registro "'.$nombre.'" Actualizado con Exito','verde');
										}
									}

								?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
									<thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
											if(!empty($_POST['buscar'])){
												$buscar=limpiar($_POST['buscar']);
												$pame=mysql_query("SELECT * FROM tipo_novedades WHERE nombre LIKE '%$buscar%' ORDER BY nombre");	
											}else{
												$pame=mysql_query("SELECT id,codigo,nombre,estado FROM tipo_novedades  ORDER BY nombre");		
											}		
											while($row=mysql_fetch_array($pame)){
											$url=$row['id'];
										?>
                                        <tr class="odd gradeX">
                                            <td><i class="fa fa-user fa-2x"></i> <?php echo $row['codigo']; ?></td>
                                            <td><i class="fa fa-user fa-2x"></i> <?php echo $row['nombre']; ?></td>
											<td><i class="fa fa-user fa-2x"></i> <?php echo $row['estado']; ?></td>
																				
                                            <td class="center">
											<div class="btn-group">
											  <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle"><i class="fa fa-cog"></i> <span class="caret"></span></button>
											  <ul class="dropdown-menu pull-right">
												<li class="divider"></li>
												<li><a  href="#" data-toggle="modal" data-target="#actualizar<?php echo $row['id']; ?>"><i class="fa fa-edit"></i> Editar</a></li>
												<li class="divider"></li>
												<li><a href="#" data-toggle="modal" data-target="#eliminar<?php echo $row['id']; ?>" ><i class="fa fa-pencil"></i> Eliminar</a></li>																																				
											  </ul>
											</div>																				
											</td>
											
									    <!--  Modals-->
										 <div class="modal fade" id="actualizar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form1" method="post" action="">
												<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar</h3>
															</div>
										<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
											<br>
											<div class="col-md-6">																				
												<div class="input-group">
												  <span class="input-group-addon">Codigo:</span>
												  <input class="form-control" name="codigo" value="<?php echo $row['codigo']; ?>"  autocomplete="off" required><br>											
											    </div><br>	

											</div>
											<div class="col-md-12">	
											<div class="input-group">
												  <span class="input-group-addon">Nombre</span>
												  <input class="form-control" title="Se necesita un nombre"  name="nombre" placeholder="Nombre Completo" value="<?php echo $row['nombre']; ?>" autocomplete="off" required><br>											
											</div><br>
											   </div><br>	


											<div class="col-md-6">
												<div class="input-group">
												  <span class="input-group-addon">Estado</span>
												  <select class="form-control" name="estado" autocomplete="off" required>
													<option value="s" <?php if($row['estado']=='s'){ echo 'selected'; } ?>>Activo</option>
													<option value="n" <?php if($row['estado']=='n'){ echo 'selected'; } ?>>No Activo</option>													
												</select>												
												</div>
											</div>                                 
     											</div>                                  
										</div> 
										</div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>		
																				
                                    </div>
                                </div>
								</form>
                            </div>
                     <!-- End Modals-->
					 <!--  Modals-->

                     <!-- End Modals-->
					 <!-- Modal -->           			
												<div class="modal fade" id="eliminar<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<form name="contado" action="index.php?del=<?php echo $row['id']; ?>" method="get">
													<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>													
																			<h3 align="center" class="modal-title" id="myModalLabel">Seguridad</h3>
																		</div>
															<div class="panel-body">
															<div class="row" align="center">                                       
																										
																<strong>Hola! <?php echo $cajero_nombre; ?></strong><br><br>
																<div class="alert alert-danger">
																	<h4>¿Esta Seguro de Realizar esta Acción?<br><br> 
																	una vez Eliminado el REGISTRO [ <?php echo $row['nombre']; ?> ]<br> 
																	no podran ser Recuperados sus datos.<br>
																	No recomendamos esta accion, sino la de "Activo" o No Activo, porque de este
																	depende mucha informcion en el Almacen de datos.
																	</h4>
																</div>																																																																																																								
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
																<a href="index.php?del=<?php echo $row['id']; ?>"  class="btn btn-danger" title="Eliminar">
																	<i class="fa fa-times" ></i> <strong>Eliminar</strong>
																</a>																
															</div>										 
														</div>
													</div>
													</form>
												</div>
										 <!-- End Modals-->       																		
                                        </tr> 
											<?php } ?>
                                    </tbody>									
                                </table>							
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
<?php }else{ echo mensajes("NO TIENES PERMISO PARA ENTRAR A ESTE FORMULARIO","rojo"); }?>				
        </div>               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../../assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
	<!-- CALENDARIO SCRIPTS -->
    <script src="../../assets/todo/bootstrap-datetimepicker.js"></script>
    <script src="../../assets/todo/locales/bootstrap-datetimepicker.es.js"></script>
	<!-- VALIDACIONES -->
	<script src="../../assets/js/jasny-bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <!-- DATATIMEPICKER -->
   <script  src="../../assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
   <script  src="../../assets/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
   <script type="text/javascript">
        $(function () {
           $('#form_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('#form_time').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
      $('#form_datex').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });	
        });
   </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>       
</body>
</html>

