<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once("../institucion/class/classInstitucion.php");
		require_once("../veredas/class/classVeredas.php");
		require_once("../tipo_instituciones/class/ClassTipoInstituciones.php");
		require_once("../funciones.php");
		
		$InstanciaDB=new Conexion();

		$InstInstitucion=new Proceso_Institucion($InstanciaDB);
		$InstVereda=new Proceso_Vereda($InstanciaDB);
		$InstTipoInstitucion=new Proceso_TipoInstitucion($InstanciaDB);
		$ListaInstitucion=$InstInstitucion->listaInstitucion();
		$listaTipoInstitucion=$InstTipoInstitucion->listatipoInstitucion();
		$listaTipoInstitucionE=$InstTipoInstitucion->listatipoInstitucion();
		$listaVereda=$InstVereda->listaVereda();
		$listaVeredaE=$InstVereda->listaVereda();
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
				
			<div class='panel-body' align='right'>  
				<button type='button' class='btn btn-success btn-circle' data-toggle='modal' data-target='#ModalNuevoInstitucion'>
					<i class='fa fa-plus fa-2x'></i>
				</button>                                                                               
			</div>
						
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Instituciones
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Codigo DANE</th>
                                            <th>Nombre Institucion</th>
											<th>Tipo</th>
											<th>Vereda</th>
											<th>Municipio</th>
											<th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaInstitucion->fetch_array()) {
												$datosInstitucion=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5];
												//echo $datosInstitucion;
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[2]; ?></td>
											<td><?php echo $row[5];	?></td>
											<td><?php echo $row[6]; ?></td>
											<td><?php echo $row[7]; ?></td>
											                                                                                  
                                            <td class="center">
												<div class="btn-group">
													<button title="Edit" onclick="formeditInstitucion('<?php echo $datosInstitucion;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarInstitucionFM"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo Institucion-->
										 	<div class="modal fade" id="ModalNuevoInstitucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nueva Institucion</h3>
															</div>
															<div id="msgInstitucionNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
																<div class="col-md-6">
																	<div class="form-group">
																		<label for="">Codigo DANE Institucion</label>														
																		<input class="form-control" name="CodDaneInstitucion" id="CodDaneInstitucion" autocomplete="off" required>
																	</div>
																	<div class="form-group">
																	  <label for="">Nombre Institucion</label>
																	  <input class="form-control" name="NombreInstitucion" id="NombreInstitucion" aria-describedby="" autocomplete="off" required>
																	</div>
														
																	<div class="form-group">
																		<label for="">Tipo de Institucion</label>
																		<select class="form-control" id="idTipoInstitucion">
																			<?php 
																				while ($rowTG=$listaTipoInstitucion->fetch_array()) {
																					echo "<option value='".$rowTG[0]."'>".$rowTG[1]."</option>";
																				}
																			?>
																		</select>
																	</div>
																	<div class="form-group">
																		<label for="">Vereda</label>
																		<select class="form-control" id="idVereda">
																			<?php 
																				while ($rowPC=$listaVereda->fetch_array()) {
																					echo "<option value='".$rowPC[0]."'>".$rowPC[1]."</option>";
																				}
																			?>
																		</select>
																	</div>
																</div>                                                            
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertInstitucion();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Institucion-->

										 <!--  Modal Editar Institucion-->
										 	<div class="modal fade" id="ModalEditarInstitucionFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Institucion</h3>
																<div id="msgEditInstitucion"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">
																		<div class="form-group">
																			<label for="">ID</label>														
																			<input class="form-control" name="idInstitucionFM" id="idInstitucionFM" disabled>
																		</div>
																		<div class="form-group">
																			<label for="">Codigo Institucion</label>														
																			<input class="form-control" name="CodDaneInstitucionFM" id="CodDaneInstitucionFM" placeholder="Codigo Institucion" autocomplete="off" required>
																		</div>
																		<div class="form-group">
																		<label for="">Descripcion Institucion</label>
																		<input class="form-control" name="NombreInstitucionFM" id="NombreInstitucionFM" aria-describedby="" placeholder="Descipcion de Institucion" autocomplete="off" required>
																		</div>
																		
																		<div class="form-group">
																			<label for="exampleFormControlSelect1">Tipo de Institucion</label>
																			<select class="form-control" id="idTipoInstitucionFM">
																				<?php 
																					while ($rowTGE=$listaTipoInstitucionE->fetch_array()) {
																						echo "<option value='".$rowTGE[0]."'>".$rowTGE[1]."</option>";
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="exampleFormControlSelect1">Vereda</label>
																			<select class="form-control" id="idVeredaFM">
																				<?php 
																					while ($rowPCE=$listaVeredaE->fetch_array()) {
																						echo "<option value='".$rowPCE[0]."'>".$rowPCE[1]."</option>";
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
																	<button type="submit" class="btn btn-primary" onclick="EditarInstitucionFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Institucion-->
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