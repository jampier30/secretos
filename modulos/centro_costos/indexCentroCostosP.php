<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../centro_costos/class/classCentrosCostosP.php');
		require_once("../funciones.php");
		$InstanciaDB=new Conexion();
		$InstCentroCostosP=new Proceso_CentroCostosP($InstanciaDB);
		$ListaCentroCostosP=$InstCentroCostosP->ListarCentroCostosP();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoCentroCostosP">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                                
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Centro de Costos Padre
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Codigo</th>
                                            <th>Descripcion</th>                                                                         
                                            <th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaCentroCostosP->fetch_array()) {
												$datosCentroCostosP=$row[0]."||".$row[1]."||".$row[2];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[2]; ?></td>                                                                                  
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditCentroCostosP('<?php echo $datosCentroCostosP;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarCentroCostosPFM"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo CentroCostosP-->
										 	<div class="modal fade" id="ModalNuevoCentroCostosP" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Centro de Costos Padre</h3>
															</div>
															<div id="msgCentroCostosPNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">Codigo Centro de Costos Padre</label>														
																		<input class="form-control" name="CodCentroCostosP" id="CodCentroCostosP" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">Descripcion Centro de Costos Padre</label>
																	  <input class="form-control" name="DescCentroCostosP" id="DescCentroCostosP" aria-describedby="emailHelpId" autocomplete="off" required>
																	</div>
																	<div>
																	
																</div> 
																</div>
																                                                                       
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertCentroCostosP();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo CentroCostosP-->

										 <!--  Modal Editar CentroCostosP-->
										 	<div class="modal fade" id="ModalEditarCentroCostosPFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Centro de Costos Padre</h3>
																<div id="msgEditCentroCostosPFM"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">																												
																		<label>ID</label>
																		<input class="form-control" id="IdCentroCostosPFM" name="IdCentroCostosPFM" disabled>
																		<label>Codigo Centro de Costos Padre</label>
																		<input class="form-control" id="CodigoCentroCostosPFM" name="CodigoCentroCostosPFM" autocomplete="off" required>
																		<label>Descripcion Centro de Costos Padre</label>
																		<input class="form-control" id="descCentroCostosPFM" name="descCentroCostosPFM" autocomplete="off" required>
																		
																	</div>                                                                       
																</div> 
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarCentroCostosPFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Centro de Costos Padre-->
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