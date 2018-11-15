<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../tipo_gastos/class/ClassTipodeGasto.php');
		require_once("../../modulos/funciones.php");
		$InstanciaDB=new Conexion();
		$InstTipoGasto=new Proceso_TipoGastos($InstanciaDB);
		$ListaTipoGastos=$InstTipoGasto->listatipogastos();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoTipoGasto">
						<i class="fa fa-plus fa-2x"></i>
					</button>                                                                               
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Tipo de Gastos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Codigo</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>                                                                                      
                                            <th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaTipoGastos->fetch_array()) {
												$datosTipoGasto=$row[0]."||".$row[1]."||".$row[2]."||".$row[3];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[2]; ?></td>
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
													<button type="button" onclick="formeditTipoGasto('<?php echo $datosTipoGasto;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarTipoGastoFM"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
								
												</a>	
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo Tipo de Gasto-->
										 	<div class="modal fade" id="ModalNuevoTipoGasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Tipo de Gasto</h3>
															</div>
															<div id="msgTipoGastoNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">Codigo tipo de Gasto</label>														
																		<input class="form-control" name="CodTipoGasto" id="CodTipoGasto" placeholder="Codigo Tipo de Gasto" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">Descripcion Tipo de Gasto</label>
																	  <input class="form-control" name="DescTipoGasto" id="DescTipoGasto" aria-describedby="emailHelpId" placeholder="Descipcion de Tipo de Gasto" autocomplete="off" required>
																	</div>
																	<div>
																	<label for="">Estado</label>
																	<select class="form-control" name="EstadoTipoGasto" id="EstadoTipoGasto" autocomplete="off" required>
																		<option value="1">ACTIVO</option>
																		<option value="0">NO ACTIVO</option>													
																	</select>
																</div> 
																</div>
																                                                                       
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertTipoGasto();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Tipo de Gasto-->

										 <!--  Modal Editar Tipo de Gasto-->
										 	<div class="modal fade" id="ModalEditarTipoGastoFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Tipo de Gasto</h3>
																<div id="msgEditTipoGastoFM"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">																												
																		<label>ID</label>
																		<input class="form-control" id="IdTipoGastoFM" name="IdTipoGastoFM" disabled>
																		<label>Codigo Tipo de Gasto</label>
																		<input class="form-control" id="CodigoTipoGastoFM" name="CodigoTipoGastoFM" autocomplete="off" required>
																		<label>Descripcion Tipo de Gasto</label>
																		<input class="form-control" id="descTipoGastoFM" name="descTipoGastoFM" autocomplete="off" required>
																		<label>Estado</label>
																		<select class="form-control" id="EstadoTipoGastoFM" name="EstadoTipoGastoFM">
																				<option value=1>ACTIVO</option>
																				<option value=0>NO ACTIVO</option>
																		</select>
																	</div>                                                                       
																</div> 
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarTipoGastoFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar TipoGasto-->
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