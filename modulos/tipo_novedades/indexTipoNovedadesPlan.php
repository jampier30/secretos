<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../tipo_novedades/class/classTipoNovedadesPlan.php');
		require_once("../../modulos/funciones.php");
		$InstanciaDB=new Conexion();
		$InstTipoNovedadesPlan=new Proceso_TipoNovedadesPla($InstanciaDB);
		$ListaTipoNovedadesPlan=$InstTipoNovedadesPlan->listatipoNovedadesPlan();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoTipoNovedadesPlan">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					<button type="button" class="btn btn-info btn-circle">
						<i class="fa fa-question fa-2x"></i>
					</button>                                                                                 
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Tipo de NovedadesPlan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Descripcion</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaTipoNovedadesPlan->fetch_array()) {
												$datosTipoNovedadesPlan=$row[0]."||".$row[1];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>                                                                                  
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditTipoNovedadesPlan('<?php echo $datosTipoNovedadesPlan;?>')" class="btn btn-success" data-toggle="modal" data-target="#ModalEditarTipoNovedadesPlanFM"><i class="fa fa-edit"></i></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo Tipo de NovedadesPlan-->
										 	<div class="modal fade" id="ModalNuevoTipoNovedadesPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Tipo de NovedadesPlan</h3>
															</div>
															<div id="msgTipoNovedadesPlanNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	
																	<div class="form-group">
																	  <label for="">Descripcion Tipo de NovedadesPlan</label>
																	  <input class="form-control" name="DescTipoNovedadesPlan" id="DescTipoNovedadesPlan" aria-describedby="emailHelpId" autocomplete="off" required>
																	</div>
																	
																</div>
																                                                                       
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertTipoNovedadesPlan();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Tipo de NovedadesPlan-->

										 <!--  Modal Editar Tipo de NovedadesPlan-->
										 	<div class="modal fade" id="ModalEditarTipoNovedadesPlanFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Tipo de NovedadesPlan</h3>
																<div id="msgEditTipoNovedadesPlanFM"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">																												
																		<label>ID</label>
																		<input class="form-control" id="IdTipoNovedadesPlanFM" name="IdTipoNovedadesPlanFM" disabled>
																		<label>Descripcion Tipo de NovedadesPlan</label>
																		<input class="form-control" id="descTipoNovedadesPlanFM" name="descTipoNovedadesPlanFM" autocomplete="off" required>
																		
																		
																	</div>                                                                       
																</div> 
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarTipoNovedadesPlanFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar TipoNovedadesPlan-->
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