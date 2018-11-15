<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../proyectos/class/classProyecto.php');
		require_once('../centro_costos/class/classCentroCostosH.php');
		require_once('../programas/class/ClassProgramas.php');
		require_once("../funciones.php");
		$InstanciaDB=new Conexion();
		$InstProyecto=new Proceso_Proyecto($InstanciaDB);
		$InstCCH=new Proceso_CentroCostosH($InstanciaDB);
		$InstPrograma=new Proceso_Programa($InstanciaDB);
        
		$ListaProyecto=$InstProyecto->ListarProyecto();
		$ListaCCH=$InstCCH->ListarCentroCostosH();
		$ListaProgramas=$InstPrograma->ListaProgramas();
		$ListaCCHE=$InstCCH->ListarCentroCostosH();
		$ListaProgramasE=$InstPrograma->ListaProgramas();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoProyecto">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                                 
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Proyectos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Descripcion Proyecto</th>
                                            <th>Centro Costos</th>                                                                         
											<th>Programa</th>
											<th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaProyecto->fetch_array()) {
												$datosProyecto=$row[0]."||".$row[1]."||".$row[2]."||".$row[3];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[4]; ?></td>
											<td><?php echo $row[7]; ?></td>
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditProyecto('<?php echo $datosProyecto;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarProyectoFM"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo Proyecto-->
										 	<div class="modal fade" id="ModalNuevoProyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Proyecto</h3>
															</div>
															<div id="msgProyectoNuevo"></div>
																<div class="panel-body">
																	<div class="row">                                       
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Descripcion Proyecto</label>														
																				<input class="form-control" name="DescProyecto" id="DescProyecto" autocomplete="off" required>
																			</div>
																			<div class="form-group">
																				<label for="">Centro de Costos</label>
																				<select class="form-control" name="idCentrodeCostosHijo" id="idCentrodeCostosHijo">
																					<?php																			
																						while ($rowCCH=$ListaCCH->fetch_array(MYSQLI_BOTH)) { 
																							echo "<option value='".$rowCCH[0]."'>".$rowCCH[1]."	- ".$rowCCH[2]."</option>";
																						}
																					?>
																				</select>
																			</div>
																			<div class="form-group">
																				<label for="">Programa</label>
																				<select class="form-control" name="idPrograma" id="idPrograma">
																					<?php																			
																						while ($rowPrograma=$ListaProgramas->fetch_array(MYSQLI_BOTH)) { 
																							echo "<option value='".$rowPrograma[0]."'>".$rowPrograma[1]." - ".$rowPrograma[2]."</option>";
																						}
																					?>
																				</select>
																			</div>
																		<div>
																	</div> 
																</div>                                                          
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertProyecto();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Proyecto-->

										 <!--  Modal Editar Proyecto-->
										 	<div class="modal fade" id="ModalEditarProyectoFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Proyecto</h3>
																<div id="msgEditProyectoFM"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">																												
																		<label>ID</label>
																		<input class="form-control" id="IdProyectoFM" name="IdProyectoFM" disabled>
																		<label>Descripcion Proyecto</label>
																		<input class="form-control" id="DescProyectoFM" name="DescProyectoFM" autocomplete="off" required>
																		<label for="">Centro de Costos</label>
																		<select class="form-control" name="idCentrodeCostosHijoFM" id="idCentrodeCostosHijoFM">
																			<?php																			
																				while ($rowCCHE=$ListaCCHE->fetch_array(MYSQLI_BOTH)) { 
																					echo "<option value='".$rowCCHE[0]."'>".$rowCCHE[1]." - ".$rowCCHE[2]."</option>";
																				}
																			?>
																		</select>
																		<label for="">Programa</label>
																		<select class="form-control" name="idProgramaFM" id="idProgramaFM">
																			<?php																			
																				while ($rowProgramaE=$ListaProgramasE->fetch_array(MYSQLI_BOTH)) { 
																					echo "<option value='".$rowProgramaE[0]."'>".$rowProgramaE[1]." - ".$rowProgramaE[2]."</option>";
																				}
																			?>
																		</select>
																	</div>                                                                       
																</div> 
															</div> 
															<div class="modal-footer">
																<div align="right">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																	<button type="submit" class="btn btn-primary" onclick="EditarProyectoFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Proyecto-->
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