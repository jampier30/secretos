<?php 
	 session_start();
	 if($_SESSION['autentic']){
		 require_once("../conn_BD.php");
         require_once('class/ClassMunicipios.php');
         require_once("../regiones/class/classRegiones.php");
         require_once("../tipo_municipios/class/ClassTipoMunicipios.php");
         require_once("../tipo_tarifas/class/ClassTipoTarifa.php");
         require_once("../departamentos/class/ClassDepartamentos.php");
		 require_once("../../modulos/funciones.php");
		 $InstanciaDB=new Conexion();
         $InsMunicipio=new Proceso_Municipios($InstanciaDB);
         $InsRegion=new Proceso_Region($InstanciaDB);
         $InsTipoMcpio=new Proceso_TipoMunicipio($InstanciaDB);
         $InsTipoTarifa=new Proceso_TipoTarifa($InstanciaDB);
         $InsDpto = new Proceso_Departamento($InstanciaDB);	
         $ListaRegion=$InsRegion->ListaRegion();
         $ListaRegionED=$InsRegion->ListaRegion();
         $ListaTipoMcpio=$InsTipoMcpio->ListaTipoMunicipio();
         $ListaTipoMcpioEd=$InsTipoMcpio->ListaTipoMunicipio();
         $ListaTipoTarifa=$InsTipoTarifa->Listatipotarifa();
         $ListaTipoTarifaEd=$InsTipoTarifa->Listatipotarifa();
         $ListaMcpio=$InsMunicipio->ListaMunicipio();
         $ListaDpto=$InsDpto->ListaDepartamento();
         $ListaDptoEd=$InsDpto->ListaDepartamento();
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
                <div class="panel-body" align="right">  
                    <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modalinsertPrograma">
                        <i class="fa fa-plus fa-2x"></i>
                    </button>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Municipios
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                                            	                               
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</i></th>
                                        <th>Cod DANE Municipio</th>
                                        <th>Nombre Municipio</th>
                                        <th>Region Municipio</th>
                                        <th>Tipo Municipio</th>
                                        <th>Tipo Tarifa</th>
                                        <th>Codigo Departamento</th>
                                        <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=$ListaMcpio->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2]."||".$row[3]."||".$row[4]."||".$row[5]."||".$row[6];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td> 
                                        <td><?php echo $row[7]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[9]; ?></td> 
                                        <td><?php echo $row[10]; ?></td> 
                                        <td><button title="Edit" onclick="formeditMunicipio('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditMcpio"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                    </tr> 
                                    <?php } ?>
                                </tbody>									
                            </table>							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de insertar Municipio nueva -->
        <div class="modal fade" id="modalinsertPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="exampleModalLabel">Nuevo Municipio</h3>
                        <div class="col-md-10">
                            <div id="msgMunicipio"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Codigo DANE Municipio</label>
                            <input type="text" class="form-control  form-control-sm" name="codMunicipio" id="codMunicipio" aria-describedby="Codigo actividad" autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre Municipio</label>
                            <input type="text" class="form-control  form-control-sm" name="descMunicipio" id="descMunicipio" aria-describedby="Descripcion actividad"  autocomplete="off" require>
                        </div>
                        <div class="form-group">
                            <label for=""> id  Region</label>
                            <select id = idRegion>
                            <option value="00"> ---- Seleccione una Region----</option>
                                <?php
                                while($row=$ListaRegion->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[1].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for=""> id  Tipo Municipio</label>
                            <select id = idTipoMcpio>
                            <option value="00"> ---- Seleccione un Tipo Municipio----</option>
                                <?php
                                while($row=$ListaTipoMcpio->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[2].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for=""> id  Tipo Tarifa</label>
                            <select id = idTipoTarifa>
                            <option value="00"> ---- Seleccione tipo Tarifa----</option>
                                <?php
                                while($row=$ListaTipoTarifa->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[1].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for=""> id  Departamento</label>
                            <select id = idDpto>
                            <option value="00"> ---- Seleccione un Departamento----</option>
                                <?php
                                while($row=$ListaDpto->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[2].'</option>';
                                }
                                ?>
                           </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="InsertMunicipio();">Guardar</button>
                    </div>
                </div>
            </div>  
        </div>
    <!-- Fin modal de insertar Municipio nuevo -->                  

    <!-- Modal para Editar Municipio-->
        <div class="modal fade" id="modaleditMcpio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Municipio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgEditMunicipio"></div>
                            <div class="form-group">
                                <label>Id  Municipio</label>
                                <input id="IdMcpioFM" name="IdMcpioFM" type="text" placeholder="formeditActividadCodigo" class="form-control" autocomplete="off" disabled>
                            </div>                           
                            <div class="form-group">
                                <label>DANE Municipio</label>
                                <input id="codDANEMcpioFM" name="codDANEMcpioFM" type="text" placeholder="formeditActividadDescripcion" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label> Descripcion Municipio</label>
                                <input id="descMcpioFM" name="descMcpioFM" type="text" placeholder="formeditUnTiempoActiv" class="form-control" autocomplete="off" required>
                            </div>
                             <div class="form-group">
                                    <label for=""> id  Region</label>
                                    <select id = idRegionFM>
                                        <option value="00"> ---- Seleccione una Region----</option>
                                            <?php
                                            while($row=$ListaRegionED->fetch_array()){
                                            echo '<option value ="'.$row[0].'">'.$row[1].'</option>';
                                            }
                                            ?>
                                    </select>
                             </div>
                             <div class="form-group">
                             <label for=""> id  Tipo Municipio</label>
                                <select id = idTipoMcpioFM>
                                <option value="00"> ---- Seleccione un tipo Municipio----</option>
                                    <?php
                                    while($row=$ListaTipoMcpioEd->fetch_array()){
                                    echo '<option value ="'.$row[0].'">'.$row[2].'</option>';
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="form-group">
                            <label for=""> id  Tipo Tarifa</label>
                            <select id = idTipoTarifaFM>
                            <option value="00"> ---- Seleccione un tipo Tarifa----</option>
                                <?php
                                while($row=$ListaTipoTarifaEd->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[1].'</option>';
                                }
                                ?>
                           </select>
                            </div>
                            <div class="form-group">
                            <label for=""> id  Departamento</label>
                            <select id = idDptoFM>
                            <option value="00"> ---- Seleccione un Departamento----</option>
                                <?php
                                while($row=$ListaDptoEd->fetch_array()){
                                   echo '<option value ="'.$row[0].'">'.$row[2].'</option>';
                                }
                                ?>
                           </select>
                             </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditarMunicipio();">Grabar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal para Editar Actividad -->

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