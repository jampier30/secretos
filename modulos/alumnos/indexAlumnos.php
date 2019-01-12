<?php 
	session_start();
	if($_SESSION['autentic']){
		require_once("../conn_BD.php");
		require_once('../alumnos/class/classAlumnos.php');
		require_once("../institucion/class/classInstitucion.php");
		require_once("../funciones.php");
		$InstanciaDB=new Conexion();

		$InstAlumnos=new Proceso_Alumnos($InstanciaDB);
		$InstInstitucion=new Proceso_Institucion($InstanciaDB);
		$ListaAlumnos=$InstAlumnos->ListarAlumnos();
		$ListaInstitucion=$InstInstitucion->listaInstitucion();
        $ListaInstitucionEd=$InstInstitucion->listaInstitucion();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- <head> -->
    <?php include_once('../headScript.php'); ?>
<!-- </head> -->        
<body><
    <div id="wrapper">
	<?php 
		include_once('../headWeb.php');
		include_once("../../menu/m_principal.php");
	?>
        <div id="page-wrapper" >
            <div id="page-inner">						                
                 <!-- /. ROW  -->               
                <div class="panel-body" align="right">                                                                                 
					<button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#ModalNuevoAlumno">
						<i class="fa fa-plus fa-2x"></i>
					</button>
					                                                                                
                </div>
            <div class="row">
                <div class="col-md-12">
                	<!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Alumnos
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
											<th>Edad</th>  
											<th>Institucion</th>                                                                                      
                                            <th><span class='glyphicon glyphicon-cog' title='Config'></span>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											while ($row=$ListaAlumnos->fetch_array()) {
												$datosAlumno=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5];
										  ?>
                                        <tr class="odd gradeX">
											<td><?php echo $row[0]; ?></td>
											<td><?php echo $row[1]; ?></td>
											<td><?php echo $row[2]; ?></td>
											<td><?php echo $row[3]; ?></td>
											<td><?php echo $row[4]; ?></td>
											<td><?php echo $row[5]; ?></td>
											<td>
												<?php 
													if ($row[4]==1) {
														echo "<span class='glyphicon glyphicon-ok-sign text-success' title='Activo'></span>"; 
													} else {
														echo "<span class='glyphicon glyphicon-minus-sign text-danger' title='Desactivado'></span>";
													}
												?>
											</td>                                                                                   
                                            <td class="center">
												<div class="btn-group">
													<button type="button" onclick="formeditAlumno('<?php echo $datosAlumno;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ModalEditarAlumno"><span class="glyphicon glyphicon-pencil"></span></button>
												</div>
											</td>
                                        </tr>
											<?php }?>       	
										
	
	
<!--  Modal Nuevo Alumno-->
		<div class="modal fade" id="ModalNuevoAlumno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<form name="form2" method="post" enctype="multipart/form-data" action="">											
				<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
					<h3 align="center" class="modal-title" id="myModalLabel">Nuevo Alumno</h3>
				</div>
					<div id="msgAlumno"></div>
					<div class="panel-body">
						<div class="row">                                       
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Codigo Alumno</label>														
									<input class="form-control" name="codAlumno" id="codAlumno" placeholder="CodigoAlumno" autocomplete="off" required>
								</div>
								<div class="form-group">
								  <label for="">Nombre Alumno</label>
								  <input class="form-control" name="descAlumno" id="descAlumno" aria-describedby="emailHelpId" placeholder="Descipcion de Alumno" autocomplete="off" required>
						    	</div>
							<div>
							<label for="">Estado</label>
							<select class="form-control" name="estado" id="estado" autocomplete="off" required>
								<option value="1">ACTIVO</option>
								<option value="0">NO ACTIVO</option>													
									</select>
									</div> 
									<div class="form-group">
										<label for="">Edad Alumno</label>
											<input class="form-control" name="edad" id="edad" aria-describedby="emailHelpId" placeholder="edad de Alumno" autocomplete="off" required>
									</div>
										<div class="form-group">
											<label for=""> Institucion</label>
											<select id = "IdInstitucion">
											<option value="00"> Seleccione una Institucion</option>
												<?php
												while($row=$ListaInstitucion->fetch_array()){
													echo "<option value='".$row[0]."'>"." # ".$row[0]." - ".$row[2]." - ".$row[7]."</option>";
												}
												?>
											</select>
										</div>			
						</div>		                                                                       
					</div> 
					</div> 
					<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" onclick="InsertAlumno();" class="btn btn-primary">Guardar</button>
				</div>										 
				</div>
				</div>
				</form>
		</div>
	<!-- End Modal Nuevo Alumno-->

	 <!--  Modal Editar Alumnos-->
										 	<div class="modal fade" id="ModalEditarAlumno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>															
																<h3 align="center" class="modal-title" id="myModalLabel">Actualizar Alumno</h3>
																<div id="msgEditAlumno"></div>
															</div>
															<div class="panel-body">
																<div class="row">                                       
																	<div class="col-md-6">	
																    	<label>ID Alumno</label>
																		<input class="form-control" id="IdAlumnoFM" name="IdAlumnoFM" disabled>																									
																		<label>Codigo Alumno</label>
																		<input class="form-control" id="codAlumnoFM" name="codAlumnoFM" required>
																		<label>Nombre Alumno</label>
																		<input class="form-control" id="descAlumnoFM" name="descAlumnoFM" autocomplete="off" required>
																		<label>Estado</label>
																		<select class="form-control" id="estadoFM" name="estadoFM">
																				<option value=1>ACTIVO</option>
																				<option value=0>NO ACTIVO</option>
																		</select>
																		<label>Edad Alumno</label>
																		<input class="form-control" id="edadFM" name="edadFM" autocomplete="off" required>
																		
																		<div class="form-group">
																			<label for="exampleFormControlSelect1">Tipo de Institucion</label>
																			<select class="form-control" id="IdInstitucFM ">
																				<?php 
																					while ($rowIST=$ListaInstitucionEd->fetch_array()) {
																						echo "<option value='".$rowIST[0]."'>"." # ".$rowIST[0]." - ".$rowIST[2]." - ".$rowIST[7]."</option>";
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
																	<button type="submit" class="btn btn-primary" onclick="EditarAlumno();">Guardar</button>
																</div> 
															</div>										 
														</div>
													</div>
												</div>										
	<!-- End Modal Editar Alumnos-->


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