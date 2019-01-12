<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once("../veredas/class/classVeredas.php");
		require_once("../empleados/class/classEmpleados.php");
		require_once("../alumnos/class/classAlumnos.php");
		require_once("../entregaAnteojos/class/classEntregaAnteojos.php");
		require_once("../municipios/class/ClassMunicipios.php");
		require_once("../funciones.php");
		$InstanciaDB=new Conexion();

		$InstVereda=new Proceso_Vereda($InstanciaDB);
		$InstEmpleados=new Proceso_Empleados($InstanciaDB);
		$InstAlumnos=new Proceso_Alumnos($InstanciaDB);
		$InstEntregaAnteojos=new Proceso_EntregaAnteojos($InstanciaDB);
		$InstMcpios= new Proceso_Municipios($InstanciaDB);

		$ListaVeredas=$InstVereda->listaVereda();
		$listaEmpleados=$InstEmpleados->ListarEmpleados();
		$ListaMcpios=$InstMcpios->ListaMunicipio();
		$listaAlumnos=$InstAlumnos->ListarAlumnos();
		$ListaEntrega=$InstEntregaAnteojos->ListarEntregaAnteojos();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevaEntregaAnteojos">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                                
                </div> 
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Entrega Anteojos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Responsable Entrega</th>
                                        
											<th>Municipio Entrega</th>
									
											<th>Beneficiario</th>
                                         
										
											<th>Persona que recibe</th>
                                            <th>Tipo Anteojos</th>
											<th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaEntrega->fetch_array()) {
												$datosEntrega=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8]."||".$row[9];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[10]; ?></td>
											<td><?php echo $row[11]; ?></td>
											<td><?php echo $row[12];	?></td>
											<td><?php echo $row[8]; ?></td>
											<td><?php echo $row[9]; ?></td>                           
											<td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditEntrega('<?php echo $datosEmpleado;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditEntregaAnteojos"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
	<!--  Modal Nuevo Entrega angteojos-->
				<div class="modal fade" id="ModalNuevaEntregaAnteojos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<form name="form2" method="post" enctype="multipart/form-data" action="">											
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
										<h3 align="center" class="modal-title" id="myModalLabel">Nueva Entrega Anteojos</h3>
									</div>
										<div id="msgEntregaAnteojos"></div>
										<div class="panel-body">
											<div class="row">  
											<div class="col-md-6">
												<div class="form-group">
															<label for="exampleFormControlSelect1">Empleado</label>
															<select class="form-control" id="IdResponsableEntr">
																<?php 
																	while ($rowEmp=$listaEmpleados->fetch_array()) {
																		echo "<option value='".$rowEmp[0]."'>".$rowEmp[1]."-".$rowEmp[2]."</option>";
																	}
																?>
															</select>
												</div>      
												<div class="form-group">
															<label for="exampleFormControlSelect1">Vereda</label>
															<select class="form-control" id="idVdaBenef">
																<?php 
																	while ($rowVda=$ListaVeredas->fetch_array()) {
																		echo "<option value='".$rowVda[0]."'>".$rowVda[1]."-".$rowVda[3]."</option>";
																	}
																?>
															</select>
												</div>         
												<div class="form-group">
															<label for="exampleFormControlSelect1">Municipio</label>
															<select class="form-control" id="Municipio">
																<?php 
																	while ($rowMcp=$ListaMcpios->fetch_array()) {
																		echo "<option value='".$rowMcp[0]."'>".$rowMcp[1]."-".$rowMcp[2]."</option>";
																	}
																?>
															</select>
												</div>                             																
												<div class="form-group">
													<div class="input-append date form_datetime" data-date="<?php echo $fechadatetimepicker;?>">
														<input id="fechaEntrega" size="16" type="text"  class="form-control" autocomplete="off" readonly style="width:230px" placeholder="fecha entrega"> 
														<span class="add-on"><i class='fas fa-calendar-alt'></i></span>
														<span class="add-on"><i class="icon-th"></i></span>																
													</div>
												</div>
												<script type="text/javascript">
														$(".form_datetime").datetimepicker({
															format: "dd/mm/yyyy",
															showMeridian: true,
															autoclose: true,
															todayBtn: true
														});
													</script>   
												<div class="form-group">
													<label for="exampleFormControlSelect1">Beneficiario</label>
													<select class="form-control" id="beneficiario">
														<?php 
														while ($rowBen=$listaAlumnos->fetch_array()) {
														echo "<option value='".$rowBen[0]."'>".$rowBen[1]."-".$rowBen[2]."</option>";
															}
														?>
													</select>
												</div>  
													<div class="form-group">
													<label for="">Telefono Beneficiario</label>
													<input class="form-control" name="telBeneficiario" id="telBeneficiario" aria-describedby="" placeholder="telefono beneficiario" autocomplete="off" required>
													</div>
													<div class="form-group">
													<label for="">Correo Beneficiario</label>
													<input class="form-control" name="correoBeneficiario" id="correoBeneficiario" aria-describedby="" placeholder="correo beneficiario" autocomplete="off" required>
													</div>
													<div class="form-group">
													<label for="">Persona que recibe</label>
													<input class="form-control" name="personaRecibe" id="personaRecibe" aria-describedby="" placeholder="persona recibe" autocomplete="off" required>
													</div>				
													<label>Tipo Anteojos</label>
														<select class="form-control" id="tipoAnteojos" name="tipo anteojo">
																<option value=1.5>1.5</option>
																<option value=2.0>2.0</option>
														</select>
												</div>
												</div>                                                            
								</div> 
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="button" onclick="guardarEntregaAnteojos();" class="btn btn-primary">Guardar</button>
								</div>										 
							</div>
						</div>
					</form>
				</div>
	<!-- End Modal Nuevo Entrega Ateojos-->

	<!--  Modal Editar Entrega anteojos-->
										 	<div class="modal fade" id="ModalEditEntregaAnteojos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Concepto Gasto</h3>
																<div id="msgEditEntrega"></div>
															</div>
															<div class="panel-body">
																	 <div class="row">  
																	  <div class="col-md-6">
																			<div class="form-group">
																						<label for="exampleFormControlSelect1">Empleado</label>
																						<select class="form-control" id="IdResponsableFM">
																							<?php 
																								while ($rowEmp=$listaEmpleados->fetch_array()) {
																									echo "<option value='".$rowEmp[0]."'>".$rowEmp[1]."-".$rowEmp[2]."</option>";
																								}
																							?>
																						</select>
																			</div>      
																			<div class="form-group">
																						<label for="exampleFormControlSelect1">Vereda</label>
																						<select class="form-control" id="idVdaBenefFM">
																							<?php 
																								while ($rowVda=$ListaVeredas->fetch_array()) {
																									echo "<option value='".$rowVda[0]."'>".$rowVda[1]."-".$rowVda[3]."</option>";
																								$Mcpio->$rowVda[3];
																								}
																							?>
																						</select>
																			</div>         
																			<div class="form-group">
																						<label for="exampleFormControlSelect1">Municipio</label>
																						<select class="form-control" id="MunicipioFM">
																							<?php 
																									echo "<option value='".$rowVda[2]."'>".$Mcpio."</option>";	
																							?>
																						</select>
																			</div>                             																
																			<div class="form-group">
																				<div class="input-append date form_datetime" data-date="<?php echo $fechadatetimepicker;?>">
																					<input id="fechaEntregaFM" size="16" type="text"  class="form-control" autocomplete="off" readonly style="width:230px" placeholder="fecha entrega"> 
																					<span class="add-on"><i class='fas fa-calendar-alt'></i></span>
																					<span class="add-on"><i class="icon-th"></i></span>																
																				</div>
																			</div>
																			<script type="text/javascript">
																					$(".form_datetime").datetimepicker({
																						format: "dd/mm/yyyy",
																						showMeridian: true,
																						autoclose: true,
																						todayBtn: true
																					});
																				</script>   
																			<div class="form-group">
																				<label for="exampleFormControlSelect1">Beneficiario</label>
																				<select class="form-control" id="beneficiarioFM">
																				    <?php 
																					while ($rowVda=$listaAlumnos->fetch_array()) {
																					echo "<option value='".$rowVda[2]."'>".$rowVda[1]."-".$rowVda[2]."</option>";
																						}
																					?>
																				</select>
																			</div>  
																				<div class="form-group">
																				<label for="">Telefono Beneficiario</label>
																				<input class="form-control" name="telBeneficiarioFM" id="telBeneficiarioFM" aria-describedby="" placeholder="telefono beneficiario" autocomplete="off" required>
																				</div>
																				<div class="form-group">
																				<label for="">Correo Beneficiario</label>
																				<input class="form-control" name="correoBeneficiarioFM" id="correoBeneficiarioFM" aria-describedby="" placeholder="correo beneficiario" autocomplete="off" required>
																				</div>
																				<div class="form-group">
																				<label for="">Persona que recibe</label>
																				<input class="form-control" name="personaRecibe" id="personaRecibe" aria-describedby="" placeholder="persona recibe" autocomplete="off" required>
																				</div>				
																				<label>Tipo Anteojos</label>
																					<select class="form-control" id="tipoAnteojosFM" name="tipo anteojo">
																							<option value=1.5>1.5</option>
																							<option value=2.0>2.0</option>
																					</select>
																			</div>
																           </div>                                                            
															</div> 
																<div class="modal-footer">
																	<div align="right">
																		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																		<button type="submit" class="btn btn-primary" onclick="EditarEntrega();">Guardar</button>
																	</div> 
																</div>										 
														</div>
													</div>
												</div>
		 <!-- End Modal Editar Entrega Anteojos-->
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
        <!-- <script>
 $(document).ready(function() {               
                $('.js-example-basic-multiple').select2({
                    placeholder:"idVdaBenef",
                    allowClear: true,
				});
 });	

            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script> -->
         <!-- CUSTOM SCRIPTS -->
    <script src="../../assets/js/custom.js"></script>
</body>
</html>
<?php 
	}else{
		header('Location:../../php_cerrar.php');
	}
?>