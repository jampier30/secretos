<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../contacto/class/classContacto.php');
		require_once('../departamentos/class/ClassDepartamentos.php');
		require_once('../regiones/class/classRegiones.php');
		require_once('../tipo_municipios/class/ClassTipoMunicipios.php');
		require_once('../clasificacionc/class/classClasificacionC.php');
		require_once("../../modulos/funciones.php");
		
		$InstanciaDB=new Conexion();
		$InstContacto=new Proceso_Contacto($InstanciaDB);
		$InstDepartamento=new Proceso_Departamento($InstanciaDB);
		$InstRegion= new Proceso_Region($InstanciaDB);
		$InstTipoMunicipio=new Proceso_TipoMunicipio($InstanciaDB);
		$InstClasificacionC=new Proceso_ClasificacionC($InstanciaDB);
		$ListaContacto=$InstContacto->listaContacto();
		$listaDepartamento=$InstDepartamento->ListaDepartamento();
		$listaDepartamentoE=$InstDepartamento->ListaDepartamento();
		$listaRegion=$InstRegion->listaRegion();
		$listaRegionE=$InstRegion->listaRegion();
		$ListaTipoMunicipio=$InstTipoMunicipio->listaTipoMunicipio();
		$ListaTipoMunicipioE=$InstTipoMunicipio->listaTipoMunicipio();
		$ListaClasificacionC=$InstClasificacionC->listaClasificacionC();
		$ListaClasificacionCE=$InstClasificacionC->listaClasificacionC();
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
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoContacto">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                               
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Contacto
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
                                        <tr>
                                            <th>Id</th>
											<th>Clasificacion</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
											<th>Departamento</th>
											<th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaContacto->fetch_array()) {
												$datosContacto=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6]."||".$row[7]."||".$row[8]."||".$row[9];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
                                            <td><?php echo $row[10]; ?></td> 
                                            <td><?php echo $row[2]; ?></td> 
                                            <td><?php echo $row[6]; ?></td>
                                            <td><?php echo $row[12]; ?></td>                                                         
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formmasinfoContacto('<?php echo $datosContacto;?>')" class="btn btn-info" data-toggle="modal" data-target="#ModalmasinfoContactoFM"><i class="fa fa-info-circle" style="color:white"></i></button>
												</div>
												<div class="btn-group">
													<button type="button" onclick="formeditContacto('<?php echo $datosContacto;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarContactoFM"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
										<!--  Modal Nuevo Contacto-->
										 	<div class="modal fade" id="ModalNuevoContacto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Contacto</h3>
															</div>
															<div id="msgContactoNuevo"></div>
																<div class="panel-body">
																	<div class="row">                                       
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="">Nombre</label>
																				<input type="text" class="form-control" name="Nombre" id="Nombre">
																			</div>
																			<div class="form-group">
																				<label for="">Clasificacion Contacto</label>
																				<select class="form-control" name="idClasificacion" id="idClasificacion">
																					<?php
																					while ($rowCLASC=$ListaClasificacionC->fetch_array(MYSQLI_BOTH)) { 
																						echo "<option value='".$rowCLASC[0]."'>".$rowCLASC[1]."	- ".$rowCLASC[2]."</option>";
																					 }
																					?>
																				</select>
																			</div>
																			<div class="form-group">
																				<label for="">Cargo</label>
																				<input type="text" class="form-control" name="CargoContacto" id="CargoContacto">
																			</div>
																			<div class="form-group">
																				<label for="">Telefono</label>
																				<input type="text" class="form-control" name="TelefonoContacto" id="TelefonoContacto">
																			</div>
																			<div class="form-group">
																				<label for="">Celular</label>
																				<input type="text" class="form-control" name="CelularContacto" id="CelularContacto">
																			</div>
																			<div class="form-group">
																				<label for="">Email</label>
																				<input type="text" class="form-control" name="emailContacto" id="emailContacto">
																			</div>
																			<div class="form-group">
																				<label for="">Region</label>
																				<select class="form-control" name="idRegion" id="idRegion">
																					<?php
																					while ($rowREG=$listaRegion->fetch_array(MYSQLI_BOTH)) { 
																						echo "<option value='".$rowREG[0]."'>".$rowREG[1]."</option>";
																					 }
																					?>
																				</select>
																				
																			</div>
																			<div class="form-group">
																				<label for="">Departamento</label>
																				<select class="form-control" name="idDepartamento" id="idDepartamento">
																					<?php
																					while ($rowCONT=$listaDepartamento->fetch_array(MYSQLI_BOTH)) { 
																						echo "<option value='".$rowCONT[0]."'>".$rowCONT[1]."	- ".$rowCONT[2]."</option>";
																					 }
																					?>
																				</select>
																			</div>
																			<div class="form-group">
																				<label for="">Tipo Municipio</label>
																				<select class="form-control" name="idTipoMunicipio" id="idTipoMunicipio">
																					<?php
																					while ($rowTMU=$ListaTipoMunicipio->fetch_array(MYSQLI_BOTH)) { 
																						echo "<option value='".$rowTMU[0]."'>".$rowTMU[1]."	- ".$rowTMU[2]."</option>";
																					 }
																					?>
																				</select>
																				
																			</div>
																		</div>                                                                
																	</div> 
																</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
																<button type="button" onclick="InsertContacto();" class="btn btn-primary">Guardar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Nuevo Contacto-->

										 <!--  Modal Editar Contacto-->
										 	<div class="modal fade" id="ModalEditarContactoFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Contacto</h3>
																<div id="msgEditContactoFM"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">
																	<div class="form-group">
																			<label for="">ID</label>
																			<input type="text" class="form-control" name="idContactoFM" id="idContactoFM" disabled>
																		</div>																										
																		<div class="form-group">
																			<label for="">Nombre</label>
																			<input type="text" class="form-control" name="NombreFM" id="NombreFM">
																		</div>
																		<div class="form-group">
																			<label for="">Clasificacion Contacto</label>
																			<select class="form-control" name="idClasificacionFM" id="idClasificacionFM">
																				<?php
																				while ($rowCLASC=$ListaClasificacionCE->fetch_array(MYSQLI_BOTH)) { 
																					echo "<option value='".$rowCLASC[0]."'>".$rowCLASC[1]."	- ".$rowCLASC[2]."</option>";
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="">Cargo</label>
																			<input type="text" class="form-control" name="CargoContactoFM" id="CargoContactoFM">
																		</div>
																		<div class="form-group">
																			<label for="">Telefono</label>
																			<input type="text" class="form-control" name="TelefonoContactoFM" id="TelefonoContactoFM">
																		</div>
																		<div class="form-group">
																			<label for="">Celular</label>
																			<input type="text" class="form-control" name="CelularContactoFM" id="CelularContactoFM">
																		</div>
																		<div class="form-group">
																			<label for="">Email</label>
																			<input type="text" class="form-control" name="emailContactoFM" id="emailContactoFM">
																		</div>
																		<div class="form-group">
																			<label for="">Region</label>
																			<select class="form-control" name="idRegionFM" id="idRegionFM">
																				<?php
																				while ($rowREG=$listaRegionE->fetch_array(MYSQLI_BOTH)) { 
																					echo "<option value='".$rowREG[0]."'>".$rowREG[1]."</option>";
																					}
																				?>
																			</select>
																			
																		</div>
																		<div class="form-group">
																			<label for="">Departamento</label>
																			<select class="form-control" name="idDepartamentoFM" id="idDepartamentoFM">
																				<?php
																				while ($rowCONT=$listaDepartamentoE->fetch_array(MYSQLI_BOTH)) { 
																					echo "<option value='".$rowCONT[0]."'>".$rowCONT[1]."	- ".$rowCONT[2]."</option>";
																					}
																				?>
																			</select>
																		</div>
																		<div class="form-group">
																			<label for="">Tipo Municipio</label>
																			<select class="form-control" name="idTipoMunicipioFM" id="idTipoMunicipioFM">
																				<?php
																				while ($rowTMU=$ListaTipoMunicipioE->fetch_array(MYSQLI_BOTH)) { 
																					echo "<option value='".$rowTMU[0]."'>".$rowTMU[1]."	- ".$rowTMU[2]."</option>";
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
																	<button type="submit" class="btn btn-primary" onclick="EditarContactoFM();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>
										 <!-- End Modal Editar Contacto-->



										<!--  Modal Mas informacion de Contacto-->
											<div class="modal fade" id="ModalmasinfoContactoFM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<form name="form2" method="post" enctype="multipart/form-data" action="">											
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Mas Informacion Contacto</h3>
															</div>
															
															<div id="msgContactoNuevo"></div>
															<div class="panel-body">
															<div class="row">                                       
															<div class="container">    
																<div class="jumbotron">
																	<div class="row">
																		<div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
																			<div class="container" style="border-bottom:1px solid black">
																				<h2><label id="NombreMI"></label></h2>
																			</div>
																			<ul class="container details">
																				<li><label>Telefono:</label><label style="margin-left:10px;" id="TelefonoContactoMI"></label></li>
																				<li><label>Celular:</label><label style="margin-left:10px;" id="CelularContactoMI"></label></li>
																				<li><label>Email:</label><label style="margin-left:10px;" id="emailContactoMI"></label></li>
																				<li><label>Region:</label><label style="margin-left:10px;" id="RegionMI"></label></li>
																				<li><label>Clasificacion:</label><label style="margin-left:10px;" id="idClasificacionMI"></label></li>
																				<li><label>Cargo:</label><label style="margin-left:10px;" id="CargoContactoMI"></label></li>
																				<li><label>Departamento:</label><label style="margin-left:10px;" id="idDepartamentoMI"></label></li>
																				<li><label>Tipo Municipio:</label><label style="margin-left:10px;" id="idTipoMunicipioMI"></label></li>
																			</ul>
																		</div>
																	</div>
																</div>                                                           
															</div> 
															</div> 
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
															</div>										 
														</div>
													</div>
												</form>
											</div>
										<!-- End Modal Mas informacion de Contacto -->
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