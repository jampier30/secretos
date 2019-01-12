<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../empleados/class/classEmpleados.php');
		require_once("../usuarios/class/ClassUsuario.php");
		require_once("../funciones.php");
		$InstanciaDB=new Conexion();
		$InstEmpleados=new Proceso_Empleados($InstanciaDB);
		$InstUsuario=new Proceso_Usuario($InstanciaDB);
		$ListaEmpleados=$InstEmpleados->ListarEmpleados();
		$ListaArea=$InstEmpleados->listarArea();
		$ListaAreaEd=$InstEmpleados->listarArea();
		$ListaUsuario=$InstUsuario->ListaUsuario();
		$ListaUsuarioEd=$InstUsuario->ListaUsuario();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoEmpleado">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                                
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Empleados
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Documento</th>
                                            <th>Nombre</th>
                                            <th>Estado</th>                                                                                      
                                            <th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaEmpleados->fetch_array()) {
												$datosEmpleado=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8]."||".$row[9]."||".$row[10]."||".$row[11];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[2]; ?></td>
											<td>
												<?php 
													if ($row[6]==1) {
														echo "<span class='glyphicon glyphicon-ok-sign text-success' title='Activo'></span>"; 
													} else {
														echo "<span class='glyphicon glyphicon-minus-sign text-danger' title='Desactivado'></span>";
													}
												?>
											</td>                                                                                   
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditEmpleado('<?php echo $datosEmpleado;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarEmpleado"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
<!--  Modal Nuevo Empleado-->
										 	<div class="modal fade" id="ModalNuevoEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																	<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Empleado</h3>
																</div>
													<div id="msgEmpleado"></div>
														<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">Documento Empleado</label>														
																		<input class="form-control" name="DocEmpleado" id="DocEmpleado" placeholder="documento empleado" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">Nombre Empleado</label>
																	  <input class="form-control" name="nomEmpleado" id="nomEmpleado" aria-describedby="emailHelpId" placeholder="nombre Empleado" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">telefono Empleado</label>
																	  <input class="form-control" name="telEmpleado" id="telEmpleado" aria-describedby="emailHelpId" placeholder="telefono Empleado" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">cargo Empleado</label>
																	  <input class="form-control" name="cargoEmpl" id="cargoEmpl" aria-describedby="emailHelpId" placeholder="cargo Empleado" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																		<label for="">Area</label>
																		<select class="form-control" id="idArea">
																			<?php 
																				while ($rowAr=$ListaArea->fetch_array()) {
																					echo "<option value='".$rowAr[0]."'>".$rowAr[1]."</option>";
																				}
																			?>
																		</select>
																	</div>

																	<div>
																		<label for="">Estado</label>
																		<select class="form-control" name="estadoEmple" id="estadoEmple" autocomplete="off" required>
																			<option value="1">ACTIVO</option>
																			<option value="0">NO ACTIVO</option>													
																		</select>
																   </div> 
																   <div class="form-group">
																		<label for="">Usuario</label>
																		<select class="form-control" id="idUsuarioEmpl">
																			<?php 
																				while ($rowUs=$ListaUsuario->fetch_array()) {
																					echo "<option value='".$rowUs[0]."'>".$rowUs[1]."</option>";
																				}
																			?>
																		</select>
																	</div>
																</div>
																                                                                       
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertEmpleado();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
<!-- End Modal Nuevo Empleado-->

	 <!--  Modal Editar Empleados-->
										 	<div class="modal fade" id="ModalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Empleado</h3>
																<div id="msgEditEmpleado"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">																												
																		<label>ID Empleado</label>
																		<input class="form-control" id="IdEmpleadoFM" name="IdEmpleadoFM" disabled>
																		<label>Codigo Empleado</label>
																		<input class="form-control" id="DocEmpleadoFM" name="DocEmpleadoFM" autocomplete="off" required>
																		<label>Nombre Empleado</label>
																		<input class="form-control" id="nomEmpleadoFM" name="nomEmpleadoFM" autocomplete="off" required>
																		<label>teléfono Empleado</label>
																		<input class="form-control" id="telEmpleadoFM" name="telEmpleadoFM" autocomplete="off" required>
																		<label>cargo Empleado</label>
																		<input class="form-control" id="cargoEmplFM" name="cargoEmplFM" autocomplete="off" required>
																			<div class="form-group">
																				<label for="exampleFormControlSelect1">Area</label>
																				<select class="form-control" id="idAreaFM ">
																					<?php 
																						while ($rowAre=$ListaAreaEd->fetch_array()) {
																							echo "<option value='".$rowAre[0]."'>".$rowAre[1]."</option>";
																						}
																					?>
																				</select>
																			</div>
																		
																		<label>Estado</label>
																		<select class="form-control" id="estadoEmpleFM" name="estadoEmpleFM">
																				<option value=1>ACTIVO</option>
																				<option value=0>NO ACTIVO</option>
																		</select>
																			<div class="form-group">
																				<label for="exampleFormControlSelect1"> Usuario</label>
																				<select class="form-control" id="idUsuarioEmplFM ">
																					<?php 
																						while ($rowUsu=$ListaUsuarioEd->fetch_array()) {
																							echo "<option value='".$rowUsu[0]."'>".$rowUsu[1]."</option>";
																						}
																					?>
																				</select>
																			</div>

																	</div>                                                                       
																</div> 
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarEmpleado();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Empleados-->
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