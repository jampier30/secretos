<?php 
     header('Content-Type: text/html; charset=UTF-8');
     session_start();
	 if($_SESSION['autentic']){
		 require_once("../conn_BD.php");
         require_once('class/ClassActividades.php');
		 require_once("../../modulos/funciones.php");
		 $InstanciaDB=new Conexion();
		 $insActividad=new Proceso_Actividad($InstanciaDB);
		 $ListaActividad=$insActividad->ListaActividad();
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
                        Actividades
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">                                            	                               
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</i></th>
                                        <th>Decripcion Actividad</th>
                                        <th>Unidad de tiempo Actividad</th>
                                        <th><span class='glyphicon glyphicon-cog' title='Config'></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=$ListaActividad->fetch_array()){
                                        $datos=$row[0]."||".$row[1]."||".$row[2];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td> 
                                        <td><button title="Edit" onclick="formeditActividad('<?php echo $datos;?>')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modaleditActividad"><span class="glyphicon glyphicon-pencil"></span></button></td>
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



    <!-- Modal de insertar Actividad nueva -->
        <div class="modal fade" id="modalinsertPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="exampleModalLabel">Nueva actividad</h3>
                        <div class="col-md-10">
                            <div id="msgActividad"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Descripcion de actividad</label>
                            <input type="text" class="form-control  form-control-sm" name="descripcionactividad" id="descripcionactividad" aria-describedby="Codigo actividad" autocomplete="off" autofocus require>
                        </div>
                        <div class="form-group">
                            <label for="">Und tiempo Actividad</label>
                            <input type="text" class="form-control  form-control-sm" name="unidadtiempoac" id="unidadtiempoac" aria-describedby="Descripcion actividad"  autocomplete="off" require>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="InsertActividad();">Guardar</button>
                    </div>
                </div>
            </div>  
        </div>
    <!-- Fin modal de insertar Programa nuevo -->
                    

    <!-- Modal para Editar Actividad-->
        <div class="modal fade" id="modaleditActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Actividad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div id="msgEditActividad"></div>
                            <div class="form-group">
                                <label>Codigo Actividad</label>
                                <input id="idActividadFM" name="idActividadFM" type="text" placeholder="formeditActividadCodigo" class="form-control" autocomplete="off" readonly>
                            </div>                           
                            <div class="form-group">
                                <label>Descripcion Actividad</label>
                                <input id="descActividadFM" name="descActividadFM" type="text" placeholder="formeditActividadDescripcion" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>unidad tiempo Actividad</label>
                                <input id="undTiempActividadFM" name="undTiempActividadFM" type="text" placeholder="formeditUnTiempoActiv" class="form-control" autocomplete="off" required>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary" onclick="EditarActividad();">Grabar</button>
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