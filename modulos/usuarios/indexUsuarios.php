<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../usuarios/class/ClassUsuario.php');
		require_once("../../modulos/funciones.php");
		$InstanciaDB=new Conexion();
		$InstUsuario=new Proceso_Usuario($InstanciaDB);
		$ListaUsuarios=$InstUsuario->ListaUsuario();
		$UltimoidUsuarios=$InstUsuario->getlastidUsuario();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- <head> -->
    <?php include_once('../headScript.php'); ?>
<!-- </head> -->        
<body>
    <div id="wrapper">
	<?php 
		include_once('../headWeb.php');
		include_once("../../menu/m_principal.php");
	?>
        <div id="page-wrapper" >
            <div id="page-inner">						                
                 <!-- /. ROW  -->               
                <div class="panel-body" align="right">                                                                                 
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoUsuario">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                                
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             USUARIOS
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Estado</th>                                                                                      
                                            <th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaUsuarios->fetch_array()) {
												$datosUsuario=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[4]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td>
												<?php 
													if ($row[3]==1) {
														echo "<span class='glyphicon glyphicon-ok-sign text-success' title='Activo'></span>"; 
													} else {
														echo "<span class='glyphicon glyphicon-minus-sign text-danger' title='Desactivado'></span>";
													}
												?>
											</td>                                                                                   
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditUsuario('<?php echo $datosUsuario;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarUsuario"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
												<a href="permisos.php?id=<?php //echo $row['doc']; ?>"  class="btn btn-danger" title="Permisos">
												<i class="fa fa-list-alt" ></i>
												</a>	
											</td>
                                        </tr>
											<?php }?>
										<!-- Modal Eliminar-->           			
												<div class="modal fade" id="eliminar<?php //echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<form name="contado" action="index.php?del=<?php //echo $row['id']; ?>" method="get">
													<input type="hidden" name="id" value="<?php //echo $row['id']; ?>">
													<div class="modal-dialog">
														<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>													
																			<h3 align="center" class="modal-title" id="myModalLabel">Seguridad</h3>
																		</div>
															<div class="panel-body">
															<div class="row" align="center">                                       
																										
																<strong>Hola! <?php //echo $cajero_nombre; ?></strong><br><br>
																<div class="alert alert-danger">
																	<h4>¿Esta Seguro de Realizar esta Acción?<br><br> 
																	una vez Eliminado el Usuario [ <?php //echo $row['nombre']; ?> ]<br> 
																	no podran ser Recuperados sus datos.<br>
																	No recomendamos esta accion, sino la de "Activo" o No Activo, porque de este
																	depende mucha informcion en el Almacen de datos.
																	</h4>
																</div>																																																																																																								
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
																<a href="index.php?del=<?php //echo $row['id']; ?>"  class="btn btn-danger" title="Eliminar">
																	<i class="fa fa-times" ></i> <strong>Eliminar</strong>
																</a>																
															</div>										 
														</div>
													</div>
													</form>
												</div>
										<!-- End Modal Eliminar -->       	
										
										<!--  Modal Nuevo Usuario-->
										 	<div class="modal fade" id="ModalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Usuario</h3>
															</div>
															<div id="msgUsuarioNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">Nombre Usuario</label>														
																		<input class="form-control" name="NombreUsuario" id="NombreUsuario" placeholder="Nombre Completo" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">Correo Electronico</label>
																	  <input type="email" class="form-control" name="EmailUsuario" id="EmailUsuario" aria-describedby="emailHelpId" placeholder="usuario@dominio.com" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																		<label for="">Clave</label>
																	  	<input type="password" class="form-control" name="ClaveUsuario" id="ClaveUsuario" placeholder="Clave" autocomplete="off" required>
																	</div>
																	<div>
																	<label for="">Estado</label>
																	<select class="form-control" name="EstadoUsuario" id="EstadoUsuario" autocomplete="off" required>
																		<option value="1">ACTIVO</option>
																		<option value="0">NO ACTIVO</option>													
																	</select>
																</div> 
																</div>
																                                                                       
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertUsuario();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Usuario-->

										 <!--  Modal Editar Usuario-->
										 	<div class="modal fade" id="ModalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Usuario</h3>
																<div id="msgEditUsuario"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">																												
																		<label>ID</label>
																		<input class="form-control" id="IdUsuarioFM" name="IdUsuarioFM" disabled>
																		<label>Email:</label>
																		<input class="form-control" id="CorreoUsuario" name="CorreoUsuario" disabled>
																		<label>Nombre:</label>
																		<input class="form-control" id="NombreUsuariof" name="NombreUsuariof" autocomplete="off" required>
																		<label>Estado</label>
																		<select class="form-control" id="EstadoUsuario" name="EstadoUsuario">
																				<option value=1>ACTIVO</option>
																				<option value=0>NO ACTIVO</option>
																		</select>
																	</div>                                                                       
																</div> 
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarUsuario();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Usuario-->
                                    </tbody>									
                                </table>							
                            </div>                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>                                
        </div>               
    </div>
  </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <script src="../../assets/js/jquery-1.10.2.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/jquery.metisMenu.js"></script>
    <script src="../../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../../assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="../../assets/js/jasny-bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>
</body>
</html>
<?php 
	}else{
		header('Location:../../php_cerrar.php');
	}
?>