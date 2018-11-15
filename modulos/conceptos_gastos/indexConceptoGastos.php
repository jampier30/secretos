<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once("../plan_cuentas/class/ClassPlanCuentas.php");
		require_once("../tipo_gastos/class/ClassTipodeGasto.php");
		require_once("../conceptos_gastos/class/classConceptoGastos.php");
		require_once("../funciones.php");
		$InstanciaDB=new Conexion();
		$InstPlanCuentas=new Proceso_PlanCuentas($InstanciaDB);
		$InstTipodeGasto=new Proceso_TipoGastos($InstanciaDB);
		$InstConceptoGastos=new Proceso_ConceptoGastos($InstanciaDB);
		$ListaPlanCuentas=$InstPlanCuentas->ListarPlanCuentas();
		$listaComboPlanCuentas=$InstPlanCuentas->ListarPlanCuentas();
		$listaTipodeGasto=$InstTipodeGasto->listatipogastos();
		$listaComboTipoGasto=$InstTipodeGasto->listatipogastos();
		$listaConceptoGasto=$InstConceptoGastos->ListarConceptoGastos();
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
					<?php
					$opcionactiva=true;
					if (($ListaPlanCuentas->num_rows == 0) or ($listaTipodeGasto->num_rows == 0)) {
						if ($ListaPlanCuentas->num_rows==0) {
							echo "<div id='msgPpal' class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No existen datos en el Concepto Gasto, primero debe agregar al menos un registro. <a href='../plan_cuentas/indexPlanCuentas.php'>Concepto Gasto</a></div>";
						} else {
							echo "<div id='msgPpal' class='alert alert-dismissible alert-danger'><strong>ERROR:</strong> No existen datos en Tipos de Gasto, primero debe agregar al menos un registro. <a href='../tipo_gastos/indexTipodeGastos.php'>Tipo de gastos</a></div>";
						}
						$opcionactiva=false;
					}else{
						$opcionactiva=true;
						echo "
						<div class='panel-body' align='right'>  
							<button type='button' class='btn btn-success btn-circle' data-toggle='modal' data-target='#ModalNuevoConceptoGasto'>
								<i class='fa fa-plus fa-2x'></i>
							</button>                                                                               
						</div>
						";
					}
					?>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Concepto de Gastos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Codigo</th>
                                            <th>Descripcion</th>
											<th>Tarifa</th>
											<th>Tipo Gasto</th>
											<th>Cuenta Contable</th>
                                            <th>Estado</th>
											<th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$listaConceptoGasto->fetch_array()) {
												$datosConceptoGasto=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8];
												//echo $datosConceptoGasto;
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[2]; ?></td>
											<td>
												<?php 
													if ($row[3]==1) {
														echo "SI";
													} else {
														echo "NO";
													}
												?>
											</td>
											<td><?php
													echo $row[4];													
												?>
											</td>
											<td><?php echo $row[5]; ?></td>
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
													<?php
														if ($opcionactiva) {?>
															<button title="Edit" onclick="formeditConceptoGasto('<?php echo $datosConceptoGasto;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarConceptoGastoFM"><span class="glyphicon glyphicon-pencil"></span></button>
														<?php } 
													?>	
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo Concepto Gasto-->
										 	<div class="modal fade" id="ModalNuevoConceptoGasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Concepto de Gastos</h3>
															</div>
															<div id="msgConceptoGastoNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">Codigo Concepto Gasto</label>														
																		<input class="form-control" name="CodigoConceptoGasto" id="CodigoConceptoGasto" placeholder="Codigo Concepto Gasto" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">Descripcion Concepto Gasto</label>
																	  <input class="form-control" name="DesConceptoGasto" id="DesConceptoGasto" aria-describedby="" placeholder="Descipcion de Concepto Gasto" autocomplete="off" required>
																	</div>
																	<div class="form-check">
																		<input type="checkbox" class="form-check-input" id="TarifaSNConceptoGasto">
																		<label class="form-check-label" for="exampleCheck1">Maneja Tarifa?</label>
																	</div>
																	<div class="form-group">
																		<label for="exampleFormControlSelect1">Tipo de Gasto</label>
																		<select class="form-control" id="TipoGastoConceptoGasto">
																			<?php 
																				while ($rowTG=$listaTipodeGasto->fetch_array()) {
																					echo "<option value='".$rowTG[0]."'>".$rowTG[1]."-".$rowTG[2]."</option>";
																				}
																			?>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="exampleFormControlSelect1">Cuenta Contable</label>
																		<select class="form-control" id="PlanCuentasConceptoGasto">
																			<?php 
																				while ($rowPC=$ListaPlanCuentas->fetch_array()) {
																					if ($rowPC[3]==1) {
																						echo "<option value='".$rowPC[0]."'>".$rowPC[1]."-".$rowPC[2]."</option>";
																					}	
																				}
																			?>
																		</select>
																	</div>
																	<div>
																	<label for="">Estado</label>
																		<select class="form-control" name="EstadoConceptoGasto" id="EstadoConceptoGasto" autocomplete="off" required>
																			<option value="1">ACTIVO</option>
																			<option value="0">NO ACTIVO</option>													
																		</select>
																	</div> 
																</div>
																                                                                       
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertConceptoGasto();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Concepto Gasto-->

										 <!--  Modal Editar Concepto Gasto-->
										 	<div class="modal fade" id="ModalEditarConceptoGastoFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Concepto Gasto</h3>
																<div id="msgEditConceptoGasto"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">
																		<div class="form-group">
																			<label for="">ID</label>														
																			<input class="form-control" name="idConceptodeGastoFM" id="idConceptodeGastoFM" disabled>
																		</div>
																		<div class="form-group">
																			<label for="">Codigo Concepto Gasto</label>														
																			<input class="form-control" name="CodigoConceptoGastoFM" id="CodigoConceptoGastoFM" placeholder="Codigo Concepto Gasto" autocomplete="off" required>
																		</div>
																		<div class="form-group">
																		<label for="">Descripcion Concepto Gasto</label>
																		<input class="form-control" name="DesConceptoGastoFM" id="DesConceptoGastoFM" aria-describedby="" placeholder="Descipcion de Concepto Gasto" autocomplete="off" required>
																		</div>
																		<div class="form-check">
																			<input type="checkbox" class="form-check-input" id="TarifaSNConceptoGastoFM">
																			<label class="form-check-label" for="exampleCheck1">Maneja Tarifa?</label>
																		</div>
																		<div class="form-group">
																			<label for="exampleFormControlSelect1">Tipo de Gasto</label>
																			<select class="form-control" id="TipoGastoConceptoGastoFM">
																				<?php 
																					while ($rowTGE=$listaComboTipoGasto->fetch_array()) {
																						echo "<option value='".$rowTGE[0]."'>".$rowTGE[1]."-".$rowTGE[2]."</option>";
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="exampleFormControlSelect1">Cuenta Contable</label>
																			<select class="form-control" id="PlanCuentasConceptoGastoFM">
																				<?php 
																					while ($rowPCE=$listaComboPlanCuentas->fetch_array()) {
																						echo "<option value='".$rowPCE[0]."'>".$rowPCE[1]."-".$rowPCE[2]."</option>";
																					}
																				?>
																			</select>
																		</div>
																		<div>
																		<label for="">Estado</label>
																			<select class="form-control" name="EstadoConceptoGastoFM" id="EstadoConceptoGastoFM" autocomplete="off" required>
																				<option value="1">ACTIVO</option>
																				<option value="0">NO ACTIVO</option>													
																			</select>
																		</div> 
																	</div>															
																</div>  
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarConceptoGastoFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Concepto Gasto-->
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